<?php

namespace Protocol\Http\Request;

use Protocol\Traits\InstanceTrait;
use RuntimeException;

/**
 * @method static $this instance(string $filename = null, string $path = null, string $type = null, int $size = null, int $error = null)
 */
class File
{
    use InstanceTrait;

    /**
     * @var int
     */
    protected $error = UPLOAD_ERR_OK;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $path;

    /**
     * Indicates whether the file was submitted via post or not. When not set the class will use `is_uploaded_file()` to
     * verify that the file is really uploaded, otherwise can trick it into thinking so. This is mostly used for testing
     * to make local files act like they are being uploaded from the client.
     *
     * @var bool
     */
    protected $post;

    /**
     * @var bool
     */
    protected $received = false;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var string
     */
    protected $type;

    /**
     * @param string $filename
     * @param string $path
     * @param string $type
     * @param int $size
     * @param int $error
     */
    function __construct($filename = null, $path = null, $type = null, $size = null, $error = null)
    {
        isset($filename) && $this->filename = $filename;
        isset($path) && $this->path = $path;
        isset($size) && $this->size = $size;
        isset($type) && $this->type = $type;
        isset($error) && $this->error = $error;
    }

    /**
     * @return int
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setError($value)
    {
        $this->error = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return isset($this->filename) ? pathinfo($this->filename, PATHINFO_EXTENSION) : null;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setExtension($value)
    {
        if (isset($this->filename)) {
            $this->filename = isset($value) ? basename($this->filename) . '.' . $value : basename($this->filename);
        } else {
            throw new RuntimeException();
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setFilename($value)
    {
        $this->filename = $value;
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
    public function isPost()
    {
        return isset($this->post) && $this->post || is_uploaded_file($this->path);
    }

    /**
     * @param boolean $value
     * @return $this
     */
    public function setPost($value)
    {
        $this->post = $value;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isReceived()
    {
        return $this->received;
    }

    /**
     * @param boolean $value
     * @return $this
     */
    public function setReceived($value)
    {
        $this->received = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setSize($value)
    {
        $this->size = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setType($value)
    {
        $this->type = $value;
        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function receive($path)
    {
        if ($this->error !== UPLOAD_ERR_OK) {
            throw new RuntimeException();
        } elseif (is_uploaded_file($this->path)) {
            move_uploaded_file($this->path, $path);
        } elseif (isset($this->post) && $this->post) {
            copy($this->path, $path);
        } else {
            throw new RuntimeException();
        }

        $this->received = true;

        return $this;
    }
}