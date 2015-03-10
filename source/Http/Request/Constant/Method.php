<?php

namespace Protocol\Http\Request\Constant;

use Spl\Constant\AbstractConstant;

/**
 * @codeCoverageIgnore
 */
final class Method extends AbstractConstant
{

    const CONNECT = 'CONNECT';
    const DELETE  = 'DELETE';
    const GET     = 'GET';
    const HEAD    = 'HEAD';
    const OPTIONS = 'OPTIONS';
    const POST    = 'POST';
    const PUT     = 'PUT';
    const TRACE   = 'TRACE';

}