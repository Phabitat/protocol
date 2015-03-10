<?php

namespace Protocol\Http\Request;

use Protocol\Http\Request\Constant\Header;
use Protocol\Http\Request\Constant\Method;
use Protocol\Traits\InstanceTrait;

/**
 * @method static $this instance()
 */
class Request
{
    use InstanceTrait;

    /**
     * @var array
     */
    protected $cookies = [];

    /**
     * Upload files provided with the request. Can be stored as a multidimensional array without any real structure, which
     * makes it a little harder to keep under control.
     *
     * ```
     * [
     *     'foo' => [
     *         'bar' => [
     *             $file1,
     *             $file2,
     *             $file3
     *         ],
     *         'baz' => $file4
     *     ],
     *     'qux' => $file5
     * ]
     * ```
     *
     * @var File[]
     */
    protected $files = [];

    /**
     * @var array
     */
    protected $getParameters = [];

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $postParameters = [];

    /**
     * @var string
     */
    protected $protocol = '1.1';

    /**
     * @var string
     */
    protected $url;

    /**
     * @return bool
     */
    public function isAjax()
    {
        return isset($this->headers[$key = Header::X_REQUESTED_WITH]) && $this->headers[$key] === 'XMLHttpRequest';
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setAjax($value)
    {
        if ($value) {
            $this->headers[Header::X_REQUESTED_WITH] = 'XMLHttpRequest';
        } else {
            unset($_SERVER[Header::X_REQUESTED_WITH]);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isConnect()
    {
        return $this->method === Method::CONNECT;
    }

    /**
     * @return array
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setCookies(array $value)
    {
        $this->cookies = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDelete()
    {
        return $this->method === Method::DELETE;
    }

    /**
     * Returns files by the specified name in the specified format. Returned files can be flattened in case if they are
     * provided as a multidimensional array. By default the returned files are flattened if the `name` is specified,
     * otherwise they get flattened only if the flag is explicitly specified.
     *
     * @param string|array $name
     * @param bool $flatten
     * @return File[]
     */
    public function getFiles($name = null, $flatten = null)
    {
        isset($flatten) || $flatten = isset($name);

        $array = $this->files;

        if (isset($name) && is_array($name)) {
            foreach ($name as $name) {
                if (!isset($array[$name])) {
                    return [];
                } elseif ($array[$name] instanceof File) {
                    return [$array[$name]];
                } else {
                    $array = $array[$name];
                }
            }
        } elseif (isset($name, $array[$name])) {
            $array = $array[$name];
        } elseif (isset($name)) {
            return [];
        }

        // If the files array is empty or there's no need to flatten it we return it as is.

        if (empty($array) || !$flatten) {
            return $array;
        }

        $closure = function (array $array) use (&$closure) {
            $files = [];

            foreach ($array as $value) {
                if (is_array($value)) {
                    empty($value) || $files = array_merge($files, $closure($value));
                } else {
                    $files[] = $value;
                }
            }

            return $files;
        };

        $array = $closure($array);

        return $array;
    }

    /**
     * @param File[] $value
     * @param string|array $name
     * @return $this
     */
    public function setFiles(array $value, $name = null)
    {
        if (isset($name) && is_array($name)) {
            $keys   = array_values($name);
            $name   = array_pop($keys);
            $array  = &$this->files;
            $arrays = [];

            foreach ($keys as $key) {
                isset($array[$key]) && is_array($array[$key]) || $array[$key] = [];
                $arrays[] = &$array;
                $array    = &$array[$key];
            }

            if (empty($value)) {
                unset($array[$name]);

                for ($i = count($keys) - 1; $i >= 0; $i--) {
                    if (empty($arrays[$i][$key = $keys[$i]])) {
                        unset($arrays[$i][$key]);
                    }
                }
            } else {
                $array[$name] = $value;
            }
        } elseif (isset($name)) {
            if (!empty($value)) {
                $this->files[$name] = $value;
            } elseif (isset($this->files[$name])) {
                unset($this->files[$name]);
            }
        } else {
            $this->files = $value;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isGet()
    {
        return $this->method === Method::GET;
    }

    /**
     * @return array
     */
    public function getGetParameters()
    {
        return $this->getParameters;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setGetParameters(array $value)
    {
        $this->getParameters = $value;
        return $this;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getGetParameter($name, $default = null)
    {

        // This was implementation with the capacity to retrieve "deep" parameters by an array of names, but later was
        // removed. Cases when we need to retrieve generic data are very rare, almost always we have the exact value path
        // and can use `isset($value['foo']['bar']['baz'])`, which is times faster compared to calculated iterations.

        return isset($this->getParameters[$name]) ? $this->getParameters[$name] : $default;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function setGetParameter($name, $value)
    {
        if (isset($value)) {
            $this->getParameters[$name] = $value;
        } elseif (isset($name, $this->getParameters[$name])) {
            unset($this->getParameters[$name]);
        }

        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasGetParameter($name)
    {
        return isset($this->getParameters[$name]);
    }

    /**
     * @return bool
     */
    public function isHead()
    {
        return $this->method === Method::HEAD;
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
    public function setHeaders($value)
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
     * @param string $name
     * @return bool
     */
    public function hasHeader($name)
    {
        return isset($this->headers[$name]);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setMethod($value)
    {
        $this->method = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOptions()
    {
        return $this->method === Method::OPTIONS;
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return $this->method === Method::POST;
    }

    /**
     * @return array
     */
    public function getPostParameters()
    {
        return $this->postParameters;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setPostParameters(array $value)
    {
        $this->postParameters = $value;
        return $this;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getPostParameter($name, $default = null)
    {

        // This was implementation with the capacity to retrieve "deep" parameters by an array of names, but later was
        // removed. Cases when we need to retrieve generic data are very rare, almost always we have the exact value path
        // and can use `isset($value['foo']['bar']['baz'])`, which is times faster compared to calculated iterations.

        return isset($this->postParameters[$name]) ? $this->postParameters[$name] : $default;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function setPostParameter($name, $value)
    {
        if (isset($value)) {
            $this->postParameters[$name] = $value;
        } elseif (isset($name, $this->postParameters[$name])) {
            unset($this->postParameters[$name]);
        }

        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasPostParameter($name)
    {
        return isset($this->postParameters[$name]);
    }

    /**
     * @return mixed
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setProtocol($value)
    {
        $this->protocol = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPut()
    {
        return $this->method === Method::PUT;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setUrl($value)
    {
        $this->url = $value;
        return $this;
    }
}