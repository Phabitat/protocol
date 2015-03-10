<?php

namespace Protocol\Http\Response;

use InvalidArgumentException;
use Protocol\Http\Response\Constant\Status;
use Protocol\Traits\InstanceTrait;

/**
 * @method static $this instance(int $statusCode = null, mixed $content = null, array $headers = null, array $cookies = null)
 */
class Response
{
    use InstanceTrait;

    /**
     * @var mixed
     */
    protected $content;

    /**
     * @var Cookie[]
     */
    protected $cookies = [];

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var string
     */
    protected $protocol = 'HTTP/1.1';

    /**
     * @var int
     */
    protected $statusCode = Status::CODE_200_OK;

    /**
     * @var string
     */
    protected $statusMessage;

    /**
     * @param int $statusCode
     * @param mixed $content
     * @param array $headers
     * @param Cookie[] $cookies
     */
    function __construct($statusCode = null, $content = null, array $headers = null, array $cookies = null)
    {
        isset($statusCode) && $this->statusCode = $statusCode;
        isset($content) && $this->content = $content;
        isset($headers) && $this->headers = $headers;
        isset($cookies) && $this->cookies = $cookies;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setContent($value)
    {
        $this->content = $value;
        return $this;
    }

    /**
     * @return Cookie[]
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * @param Cookie[] $value
     * @return $this
     */
    public function setCookies(array $value)
    {
        $this->cookies = $value;
        return $this;
    }

    /**
     * @param string $name
     * @return Cookie
     */
    public function getCookie($name)
    {
        foreach ($this->cookies as $cookie) {
            if ($cookie->getName() === $name) {
                return $cookie;
            }
        }

        return null;
    }

    /**
     * @param Cookie|Cookie[] $cookie
     * @return $this
     */
    public function addCookie($cookie)
    {
        foreach (is_array($cookie) ? $cookie : [$cookie] as $cookie) {
            if (!isset($this->cookies[$hash = spl_object_hash($cookie)])) {
                $this->cookies[$hash] = $cookie;
            }
        }

        return $this;
    }

    /**
     * @param Cookie|Cookie[] $cookie
     * @return $this
     */
    public function removeCookie($cookie)
    {
        foreach (is_array($cookie) ? $cookie : [$cookie] as $cookie) {
            if (isset($this->cookies[$hash = spl_object_hash($cookie)])) {
                unset($this->cookies[$hash]);
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setHeaders(array $value)
    {
        $this->headers = $value;
        return $this;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getHeader($name)
    {
        return isset($this->headers[$name]) ? $this->headers[$name] : null;
    }

    /**
     * @param string $name
     * @param array $value
     * @return $this
     */
    public function setHeader($name, $value)
    {
        if (isset($name, $value)) {
            $this->headers[$name] = $value;
        } elseif (isset($name, $this->headers[$name])) {
            unset($this->headers[$name]);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        if (isset($this->statusCode, $this->statusMessage)) {
            return "{$this->statusCode} {$this->statusMessage}";
        }

        return isset($this->statusCode) ? ($code = $this->statusCode) . ' ' . Status::getMessage($code) : Status::STATUS_200_OK;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setStatus($value)
    {
        if (isset($value) && preg_match('/^(\\d{3}) (.+)/', $value, $matches) === 1) {
            $this->statusCode    = (int) $matches[1];
            $this->statusMessage = $matches[2];
        } elseif (isset($value)) {
            throw new InvalidArgumentException();
        } else {
            $this->statusCode    = null;
            $this->statusMessage = null;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setStatusCode($value)
    {
        return $this->statusCode = $value;
    }

    /**
     * @param bool $resolve
     * @return string
     */
    public function getStatusMessage($resolve = false)
    {
        return isset($this->statusMessage) || !$resolve || !isset($this->statusCode) ? $this->statusMessage : Status::getMessage($this->statusCode);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setStatusMessage($value)
    {
        $this->statusMessage = $value;
        return $this;
    }

    /**
     * @return $this
     */
    public function sendHeaders()
    {

        // Todo: I think this must go into skeleton.

        if (headers_sent()) {
            return $this;
        }

        // Status line

        header("{$this->protocol} {$this->getStatus()}");

        // Headers

        foreach ($this->headers as $name => $header) {
            header("{$name}: {$header}");
        }

        // Cookies

        foreach ($this->cookies as $cookie) {
            setcookie($cookie->getName(), $cookie->getValue(), $cookie->getExpire(), $cookie->getPath(), $cookie->getDomain(), $cookie->isSecure(), $cookie->isHttpOnly());
        }

        return $this;
    }
}