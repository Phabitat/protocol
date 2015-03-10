<?php

namespace Protocol\Http\Request\Factory;

use InvalidArgumentException;
use Protocol\Http\Request\Constant\Header;
use Protocol\Http\Request\File;
use Protocol\Http\Request\Request;
use Protocol\Traits\InstanceTrait;

/**
 * Superglobals factory constructs a request from the data provided via `$_COOKIE`, `$_GET`, `$_POST` and `$_SERVER`
 * superglobals.
 */
class SuperglobalsFactory
{
    use InstanceTrait;

    /**
     * @var array
     */
    protected $headerMap = [];

    /**
     * @var Request
     */
    protected $request;

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
     * @return Request
     */
    public function construct()
    {
        $request = isset($this->request) ? $this->request : new Request();

        // Update get and post parameters.

        empty($_GET) || $request->setGetParameters($_GET);
        empty($_POST) || $request->setPostParameters($_POST);

        // Parse method, url, protocol and headers.

        $server = isset($_SERVER) ? $_SERVER : [];

        // Update method.

        if (isset($server[$key = 'REQUEST_METHOD'])) {
            $request->setMethod($server[$key]);
            unset($server[$key]);
        }

        // Update url.

        if (isset($server[$key = 'REQUEST_URI'])) {
            $request->setUrl($server[$key]);
            unset($server[$key]);
        }

        // Update protocol.

        if (isset($server[$key = 'SERVER_PROTOCOL'])) {
            $request->setProtocol($server[$key]);
            unset($server[$key]);
        }

        // Update headers.

        $headers = [];
        $map     = [];

        foreach (Header::getValues() as $value) {
            $map['HTTP_' . strtoupper(preg_replace('/[^0-9a-zA-Z]/', '_', $value))] = $value;
        }

        foreach ($server as $key => $value) {
            isset($map[$key]) && $headers[$map[$key]] = $value;
        }

        empty($headers) || $request->setHeaders($headers);

        // Update cookies.

        empty($_COOKIE) || $request->setCookies($_COOKIE);

        // Update files.

        $files = isset($_FILES) ? $_FILES : [];

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
}