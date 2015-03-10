<?php

namespace Protocol\Traits;

trait InstanceTrait
{

    /**
     * @param ...$arguments
     * @return static
     */
    public static function instance(...$arguments)
    {
        return new static(...$arguments);
    }
}