<?php

namespace Protocol\Http\Response;

use DateTime;

class Cookie
{

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var DateTime
     */
    protected $expire;

    /**
     * @var bool
     */
    protected $httpOnly;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var bool
     */
    protected $secure;

    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $name
     * @param string $value
     * @param DateTime $expire
     * @param string $path
     * @param null $domain
     * @param bool $secure
     * @param bool $httpOnly
     */
    public function __construct($name, $value = null, DateTime $expire = null, $path = null, $domain = null, $secure = null, $httpOnly = null)
    {
        isset($name) && $this->name = $name;
        isset($value) && $this->value = $value;
        isset($domain) && $this->domain = $domain;
        isset($expire) && $this->expire = $expire;
        isset($path) && $this->path = $path;
        isset($secure) && $this->secure = $secure;
        isset($httpOnly) && $this->httpOnly = $httpOnly;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setDomain($value)
    {
        $this->domain = $value;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExpire()
    {
        return $this->expire;
    }

    /**
     * @param DateTime $value
     * @return $this
     */
    public function setExpire($value)
    {
        $this->expire = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHttpOnly()
    {
        return $this->httpOnly;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setHttpOnly($value)
    {
        $this->httpOnly = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPath($value)
    {
        $this->path = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSecure()
    {
        return $this->secure;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setSecure($value)
    {
        $this->secure = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}