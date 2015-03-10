<?php

namespace Protocol\Http\Request\Constant;

use Spl\Constant\AbstractConstant;

/**
 * @codeCoverageIgnore
 */
class Header extends AbstractConstant
{

    /*
     * Standard headers
     */

    const ACCEPT              = 'Accept';
    const ACCEPT_CHARSET      = 'Accept-Charset';
    const ACCEPT_DATETIME     = 'Accept-Datetime';
    const ACCEPT_ENCODING     = 'Accept-Encoding';
    const ACCEPT_LANGUAGE     = 'Accept-Language';
    const AUTHORIZATION       = 'Authorization';
    const CACHE_CONTROL       = 'Cache-Control';
    const CONNECTION          = 'Connection';
    const CONTENT_LENGTH      = 'Content-Length';
    const CONTENT_MD5         = 'Content-MD5';
    const CONTENT_TYPE        = 'Content-Type';
    const COOKIE              = 'Cookie';
    const DATE                = 'Date';
    const EXPECT              = 'Expect';
    const FROM                = 'From';
    const HOST                = 'Host';
    const IF_MATCH            = 'If-Match';
    const IF_MODIFIED_SINCE   = 'If-Modified-Since';
    const IF_NONE_MATCH       = 'If-None-Match';
    const IF_RANGE            = 'If-Range';
    const IF_UNMODIFIED_SINCE = 'If-Unmodified-Since';
    const MAX_FORWARDS        = 'Max-Forwards';
    const ORIGIN              = 'Origin';
    const PRAGMA              = 'Pragma';
    const PROXY_AUTHORIZATION = 'Proxy-Authorization';
    const RANGE               = 'Range';
    const REFERER             = 'Referer';
    const TE                  = 'TE';
    const UPGRADE             = 'Upgrade';
    const USER_AGENT          = 'User-Agent';
    const VIA                 = 'Via';
    const WARNING             = 'Warning';
    /*
     * Common non-standard headers
     */

    const X_ATT_DEVICE_ID        = 'X-ATT-DeviceId';
    const X_FORWARDED_HOST       = 'X-Forwarded-Host';
    const X_FORWARDED_PROTO      = 'X-Forwarded-Proto';
    const X_HTTP_METHOD_OVERRIDE = 'X-Http-Method-Override';
    const X_REQUESTED_WITH       = 'X-Requested-With';
    const X_WAP_PROFILE          = 'X-Wap-Profile';

}