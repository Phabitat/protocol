<?php

namespace Protocol\Http\Request\Factory;

use InvalidArgumentException;
use Protocol\Http\Constant\MediaType;
use Protocol\Http\Request\Constant\Header;
use Protocol\Http\Request\Constant\Method;
use Protocol\Http\Request\File;
use Protocol\Http\Request\Request;
use Protocol\Traits\InstanceTrait;
use Spl\Factory\AbstractFactory;

/**
 * Superglobals factory constructs a request from the data provided via `$_COOKIE`, `$_GET`, `$_POST` and `$_SERVER`
 * superglobals.
 */
class SuperglobalsFactory extends AbstractFactory
{
    use InstanceTrait;

    /**
     * When defined will be used instead of `$_COOKIE` superglobal.
     *
     * @type array
     */
    protected $cookie;

    /**
     * When defined will be used instead of `$_FILES` superglobal.
     *
     * @type array
     */
    protected $files;

    /**
     * When defined will be used instead of `$_GET` superglobal.
     *
     * @type array
     */
    protected $get;

    /**
     * @type array
     */
    protected $headerMap = [];

    /**
     * When defined will be used instead of `php://input` stream data.
     *
     * @type string
     */
    protected $input;

    /**
     * Specifies whether to use received json as post parameters when request is made with POST, but `$_POST` is empty
     * and content type is `application/json`.
     *
     * @type boolean
     */
    protected $jsonAsPost = true;

    /**
     * When defined will be used instead of `$_POST` superglobal.
     *
     * @type array
     */
    protected $post;

    /**
     * @var Request
     */
    protected $request;

    /**
     * When defined will be used instead of `$_SERVER` superglobal.
     *
     * @type array
     */
    protected $server;

    /**
     * @return array
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setCookie(array $value = null)
    {
        $this->cookie = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setFiles(array $value = null)
    {
        $this->files = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setGet(array $value = null)
    {
        $this->get = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaderMap()
    {
        return $this->headerMap;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setHeaderMap(array $value)
    {
        $this->headerMap = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setInput($value)
    {
        $this->input = $value;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isJsonAsPost()
    {
        return $this->jsonAsPost;
    }

    /**
     * @param boolean $value
     * @return $this
     */
    public function useJsonAsPost($value)
    {
        $this->jsonAsPost = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setPost(array $value = null)
    {
        $this->post = $value;
        return $this;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $value
     * @return $this
     */
    public function setRequest(Request $value = null)
    {
        $this->request = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setServer(array $value = null)
    {
        $this->server = $value;
        return $this;
    }

    /**
     * @return Request
     */
    public function construct()
    {
        $request = isset($this->request) ? $this->request : new Request();

        // Parse method, url, protocol and headers.

        $server = isset($this->server) ? $this->server : $_SERVER;
        isset($server) || $server = [];

        if (isset($server[$key = 'REQUEST_METHOD'])) {
            $request->setMethod($method = $server[$key]);
            unset($server[$key]);
        }

        if (isset($server[$key = 'REQUEST_URI'])) {
            $request->setUrl($server[$key]);
            unset($server[$key]);
        }

        if (isset($server[$key = 'SERVER_PROTOCOL'])) {
            $request->setProtocol($server[$key]);
            unset($server[$key]);
        }

        // Update get and post parameters.

        $get  = isset($this->get) ? $this->get : $_GET;
        $post = isset($this->post) ? $this->post : $_POST;

        empty($get) || $request->setGetParameters($get);

        if (!empty($post)) {
            $request->setPostParameters($post);
        } elseif ($this->jsonAsPost && isset($method, $server[$key = 'CONTENT_TYPE']) && ($method === Method::POST || $method === Method::PUT) && $server[$key] === MediaType::JSON) {
            empty($json = json_decode(isset($this->input) ? $this->input : file_get_contents('php://input'), true)) || $request->setPostParameters($json);
        }

        // Update headers.

        $map     = $this->headerMap;
        $headers = [];

        foreach (Header::getValues() as $value) {
            $map['HTTP_' . strtoupper(preg_replace('/[^0-9a-zA-Z]/', '_', $value))] = $value;
        }

        foreach ($server as $key => $value) {
            isset($map[$key]) && $headers[$map[$key]] = $value;
        }

        empty($headers) || $request->setHeaders($headers);

        // Update cookies.

        $cookie = isset($this->cookie) ? $this->cookie : $_COOKIE;
        empty($cookie) || $request->setCookies($cookie);

        // Update files.

        $files = isset($this->files) ? $this->files : $_FILES;
        isset($files) || $files = [];

        foreach ($files as $key => $file) {
            $files[$key] = $this->normaliseFile($file['name'], $file['tmp_name'], $file['type'], $file['size'], $file['error']);
        }

        empty($files) || $request->setFiles($files);

        return $request;
    }

    /**
     * @param array|string $name
     * @param array|string $path
     * @param array|string $type
     * @param array|int $size
     * @param array|int $error
     * @return array|File
     */
    protected function normaliseFile($name, $path, $type, $size, $error)
    {
        $isNameArray  = is_array($name);
        $isPathArray  = is_array($path);
        $isTypeArray  = is_array($type);
        $isSizeArray  = is_array($size);
        $isErrorArray = is_array($error);

        if (!$isNameArray && !$isPathArray && !$isTypeArray && !$isSizeArray && !$isErrorArray) {
            return $this->constructFile($name, $path, $size, $type, $error);
        } elseif (!$isNameArray || !$isPathArray || !$isTypeArray || !$isSizeArray || !$isErrorArray) {
            throw new InvalidArgumentException();
        }

        $files = [];

        foreach ($name as $key => $name) {
            if (isset($type[$key], $path[$key], $error[$key], $size[$key])) {
                $files[$key] = $this->normaliseFile($name, $path[$key], $type[$key], $size[$key], $error[$key]);
            } else {
                throw new InvalidArgumentException();
            }
        }

        return $files;
    }

    /**
     * @param string $name
     * @param string $path
     * @param string $type
     * @param int $size
     * @param int $error
     * @return File
     */
    protected function constructFile($name, $path, $type, $size, $error)
    {
        return new File($name, $path, $size, $type, $error);
    }

    /**
     * @inheritdoc
     */
    public function reset()
    {
        $this->cookie     = null;
        $this->files      = null;
        $this->get        = null;
        $this->input      = null;
        $this->jsonAsPost = true;
        $this->post       = null;
        $this->request    = null;

        return $this;
    }

}