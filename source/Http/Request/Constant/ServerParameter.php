<?php

namespace Protocol\Http\Request\Constant;

use Spl\Constant\AbstractConstant;

/**
 * @codeCoverageIgnore
 */
final class ServerParameter extends AbstractConstant
{

    const AUTH_TYPE            = 'AUTH_TYPE';
    const DOCUMENT_ROOT        = 'DOCUMENT_ROOT';
    const GATEWAY_INTERFACE    = 'GATEWAY_INTERFACE';
    const HTTPS                = 'HTTPS';
    const ORIG_PATH_INFO       = 'ORIG_PATH_INFO';
    const PATH_INFO            = 'PATH_INFO';
    const PATH_TRANSLATED      = 'PATH_TRANSLATED';
    const PHP_AUTH_DIGEST      = 'PHP_AUTH_DIGEST';
    const PHP_AUTH_PASSWORD    = 'PHP_AUTH_PW';
    const PHP_AUTH_USER        = 'PHP_AUTH_USER';
    const PHP_SELF             = 'PHP_SELF';
    const QUERY_STRING         = 'QUERY_STRING';
    const REDIRECT_REMOTE_USER = 'REDIRECT_REMOTE_USER';
    const REMOTE_ADDRESS       = 'REMOTE_ADDR';
    const REMOTE_HOST          = 'REMOTE_HOST';
    const REMOTE_PORT          = 'REMOTE_PORT';
    const REMOTE_USER          = 'REMOTE_USER';
    const REQUEST_METHOD       = 'REQUEST_METHOD';
    const REQUEST_TIME         = 'REQUEST_TIME';
    const REQUEST_TIME_FLOAT   = 'REQUEST_TIME_FLOAT';
    const REQUEST_URI          = 'REQUEST_URI';
    const SCRIPT_FILENAME      = 'SCRIPT_FILENAME';
    const SCRIPT_NAME          = 'SCRIPT_NAME';
    const SERVER_ADDRESS       = 'SERVER_ADDR';
    const SERVER_ADMIN         = 'SERVER_ADMIN';
    const SERVER_NAME          = 'SERVER_NAME';
    const SERVER_PORT          = 'SERVER_PORT';
    const SERVER_PROTOCOL      = 'SERVER_PROTOCOL';
    const SERVER_SIGNATURE     = 'SERVER_SIGNATURE';
    const SERVER_SOFTWARE      = 'SERVER_SOFTWARE';

}