<?php

namespace Protocol\Http\Response\Constant;

use Spl\Constant\AbstractConstant;

/**
 * Represents RFC 2616 HTTP response status codes and their messages, so that you don't have to learn them.
 *
 * @link http://www.w3.org/Protocols/rfc2616/rfc2616.html
 * @link http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
 *
 * @codeCoverageIgnore
 */
final class Status extends AbstractConstant
{

    // 1XX Information

    const CODE_100_CONTINUE            = 100;
    const CODE_101_SWITCHING_PROTOCOLS = 101;
    const CODE_102_PROCESSING          = 102;

    // 2XX Success

    const CODE_200_OK                            = 200;
    const CODE_201_CREATED                       = 201;
    const CODE_202_ACCEPTED                      = 202;
    const CODE_203_NON_AUTHORITATIVE_INFORMATION = 203;
    const CODE_204_NO_CONTENT                    = 204;
    const CODE_205_RESET_CONTENT                 = 205;
    const CODE_206_PARTIAL_CONTENT               = 206;

    // 3XX Redirect

    const CODE_300_MULTIPLE_CHOICES   = 300;
    const CODE_301_MOVED_PERMANENTLY  = 301;
    const CODE_302_FOUND              = 302;
    const CODE_303_SEE_OTHER          = 303;
    const CODE_304_NOT_MODIFIED       = 304;
    const CODE_305_USE_PROXY          = 305;
    const CODE_306_SWITCH_PROXY       = 306; // @deprecated
    const CODE_307_TEMPORARY_REDIRECT = 307;

    // 4XX Client error

    const CODE_400_BAD_REQUEST                     = 400;
    const CODE_401_UNAUTHORIZED                    = 401;
    const CODE_402_PAYMENT_REQUIRED                = 402;
    const CODE_403_FORBIDDEN                       = 403;
    const CODE_404_NOT_FOUND                       = 404;
    const CODE_405_METHOD_NOT_ALLOWED              = 405;
    const CODE_406_NOT_ACCEPTABLE                  = 406;
    const CODE_407_PROXY_AUTHENTICATION_REQUIRED   = 407;
    const CODE_408_REQUEST_TIMEOUT                 = 408;
    const CODE_409_CONFLICT                        = 409;
    const CODE_410_GONE                            = 410;
    const CODE_411_LENGTH_REQUIRED                 = 411;
    const CODE_412_PRECONDITION_FAILED             = 412;
    const CODE_413_REQUEST_ENTITY_TOO_LARGE        = 413;
    const CODE_414_REQUEST_URI_TOO_LONG            = 414;
    const CODE_415_UNSUPPORTED_MEDIA_TYPE          = 415;
    const CODE_416_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const CODE_417_EXPECTATION_FAILED              = 417;

    // 5XX Server error

    const CODE_500_INTERNAL_SERVER_ERROR      = 500;
    const CODE_501_NOT_IMPLEMENTED            = 501;
    const CODE_502_BAD_GATEWAY                = 502;
    const CODE_503_SERVICE_UNAVAILABLE        = 503;
    const CODE_504_GATEWAY_TIMEOUT            = 504;
    const CODE_505_HTTP_VERSION_NOT_SUPPORTED = 505;

    // 1XX Information

    const MESSAGE_100_CONTINUE            = 'Continue';
    const MESSAGE_101_SWITCHING_PROTOCOLS = 'Switching Protocols';
    const MESSAGE_102_PROCESSING          = 'Processing';

    // 2XX Success

    const MESSAGE_200_OK                            = 'OK';
    const MESSAGE_201_CREATED                       = 'Created';
    const MESSAGE_202_ACCEPTED                      = 'Accepted';
    const MESSAGE_203_NON_AUTHORITATIVE_INFORMATION = 'Non-Authoritative Information';
    const MESSAGE_204_NO_CONTENT                    = 'No Content';
    const MESSAGE_205_RESET_CONTENT                 = 'Reset Content';
    const MESSAGE_206_PARTIAL_CONTENT               = 'Partial Content';

    // 3XX Redirect

    const MESSAGE_300_MULTIPLE_CHOICES   = 'Multiple Choices';
    const MESSAGE_301_MOVED_PERMANENTLY  = 'Moved Permanently';
    const MESSAGE_302_FOUND              = 'Found';
    const MESSAGE_303_SEE_OTHER          = 'See Other';
    const MESSAGE_304_NOT_MODIFIED       = 'Not Modified';
    const MESSAGE_305_USE_PROXY          = 'Use Proxy';
    const MESSAGE_306_SWITCH_PROXY       = 'Switch Proxy'; // @deprecated
    const MESSAGE_307_TEMPORARY_REDIRECT = 'Temporary Redirect';

    // 4XX Client error

    const MESSAGE_400_BAD_REQUEST                     = 'Bad Request';
    const MESSAGE_401_UNAUTHORIZED                    = 'Unauthorized';
    const MESSAGE_402_PAYMENT_REQUIRED                = 'Payment Required';
    const MESSAGE_403_FORBIDDEN                       = 'Forbidden';
    const MESSAGE_404_NOT_FOUND                       = 'Not Found';
    const MESSAGE_405_METHOD_NOT_ALLOWED              = 'Method Not Allowed';
    const MESSAGE_406_NOT_ACCEPTABLE                  = 'Not Acceptable';
    const MESSAGE_407_PROXY_AUTHENTICATION_REQUIRED   = 'Proxy Authentication Required';
    const MESSAGE_408_REQUEST_TIMEOUT                 = 'Request Timeout';
    const MESSAGE_409_CONFLICT                        = 'Conflict';
    const MESSAGE_410_GONE                            = 'Gone';
    const MESSAGE_411_LENGTH_REQUIRED                 = 'Length Required';
    const MESSAGE_412_PRECONDITION_FAILED             = 'Precondition Failed';
    const MESSAGE_413_REQUEST_ENTITY_TOO_LARGE        = 'Request Entity Too Large';
    const MESSAGE_414_REQUEST_URI_TOO_LONG            = 'Request-URI Too Long';
    const MESSAGE_415_UNSUPPORTED_MEDIA_TYPE          = 'Unsupported Media Type';
    const MESSAGE_416_REQUESTED_RANGE_NOT_SATISFIABLE = 'Requested Range Not Satisfiable';
    const MESSAGE_417_EXPECTATION_FAILED              = 'Expectation Failed';

    // 5XX Server error

    const MESSAGE_500_INTERNAL_SERVER_ERROR      = 'Internal Server Error';
    const MESSAGE_501_NOT_IMPLEMENTED            = 'Not Implemented';
    const MESSAGE_502_BAD_GATEWAY                = 'Bad Gateway';
    const MESSAGE_503_SERVICE_UNAVAILABLE        = 'Service Unavailable';
    const MESSAGE_504_GATEWAY_TIMEOUT            = 'Gateway Timeout';
    const MESSAGE_505_HTTP_VERSION_NOT_SUPPORTED = 'HTTP Version Not Supported';

    // 1XX Information

    const STATUS_100_CONTINUE            = '100 Continue';
    const STATUS_101_SWITCHING_PROTOCOLS = '101 Switching Protocols';
    const STATUS_102_PROCESSING          = '102 Processing';

    // 2XX Success

    const STATUS_200_OK                            = '200 OK';
    const STATUS_201_CREATED                       = '201 Created';
    const STATUS_202_ACCEPTED                      = '202 Accepted';
    const STATUS_203_NON_AUTHORITATIVE_INFORMATION = '203 Non-Authoritative Information';
    const STATUS_204_NO_CONTENT                    = '204 No Content';
    const STATUS_205_RESET_CONTENT                 = '205 Reset Content';
    const STATUS_206_PARTIAL_CONTENT               = '206 Partial Content';

    // 3XX Redirect

    const STATUS_300_MULTIPLE_CHOICES   = '300 Multiple Choices';
    const STATUS_301_MOVED_PERMANENTLY  = '301 Moved Permanently';
    const STATUS_302_FOUND              = '302 Found';
    const STATUS_303_SEE_OTHER          = '303 See Other';
    const STATUS_304_NOT_MODIFIED       = '304 Not Modified';
    const STATUS_305_USE_PROXY          = '305 Use Proxy';
    const STATUS_306_SWITCH_PROXY       = '306 Switch Proxy';
    const STATUS_307_TEMPORARY_REDIRECT = '307 Temporary Redirect';

    // 4XX Client error

    const STATUS_400_BAD_REQUEST                     = '400 Bad Request';
    const STATUS_401_UNAUTHORIZED                    = '401 Unauthorized';
    const STATUS_402_PAYMENT_REQUIRED                = '402 Payment Required';
    const STATUS_403_FORBIDDEN                       = '403 Forbidden';
    const STATUS_404_NOT_FOUND                       = '404 Not Found';
    const STATUS_405_METHOD_NOT_ALLOWED              = '405 Method Not Allowed';
    const STATUS_406_NOT_ACCEPTABLE                  = '406 Not Acceptable';
    const STATUS_407_PROXY_AUTHENTICATION_REQUIRED   = '407 Proxy Authentication Required';
    const STATUS_408_REQUEST_TIMEOUT                 = '408 Request Timeout';
    const STATUS_409_CONFLICT                        = '409 Conflict';
    const STATUS_410_GONE                            = '410 Gone';
    const STATUS_411_LENGTH_REQUIRED                 = '411 Length Required';
    const STATUS_412_PRECONDITION_FAILED             = '412 Precondition Failed';
    const STATUS_413_REQUEST_ENTITY_TOO_LARGE        = '413 Request Entity Too Large';
    const STATUS_414_REQUEST_URI_TOO_LONG            = '414 Request-URI Too Long';
    const STATUS_415_UNSUPPORTED_MEDIA_TYPE          = '415 Unsupported Media Type';
    const STATUS_416_REQUESTED_RANGE_NOT_SATISFIABLE = '416 Requested Range Not Satisfiable';
    const STATUS_417_EXPECTATION_FAILED              = '417 Expectation Failed';

    // 5XX Server error

    const STATUS_500_INTERNAL_SERVER_ERROR      = '500 Internal Server Error';
    const STATUS_501_NOT_IMPLEMENTED            = '501 Not Implemented';
    const STATUS_502_BAD_GATEWAY                = '502 Bad Gateway';
    const STATUS_503_SERVICE_UNAVAILABLE        = '503 Service Unavailable';
    const STATUS_504_GATEWAY_TIMEOUT            = '504 Gateway Timeout';
    const STATUS_505_HTTP_VERSION_NOT_SUPPORTED = '505 HTTP Version Not Supported';

    /**
     * @var array
     */
    protected static $codes;

    /**
     * @var array
     */
    protected static $combinedCodes;

    /**
     * @var array
     */
    protected static $combinedMessages;

    /**
     * @var array
     */
    protected static $combinedStatuses;

    /**
     * @var array
     */
    protected static $messages;

    /**
     * @var array
     */
    protected static $messagesByCode = [

        // 1XX Information

        self::CODE_100_CONTINUE            => self::MESSAGE_100_CONTINUE,
        self::CODE_101_SWITCHING_PROTOCOLS => self::MESSAGE_101_SWITCHING_PROTOCOLS,
        self::CODE_102_PROCESSING          => self::MESSAGE_102_PROCESSING,

        // 2XX Success

        self::CODE_200_OK                            => self::MESSAGE_200_OK,
        self::CODE_201_CREATED                       => self::MESSAGE_201_CREATED,
        self::CODE_202_ACCEPTED                      => self::MESSAGE_202_ACCEPTED,
        self::CODE_203_NON_AUTHORITATIVE_INFORMATION => self::MESSAGE_203_NON_AUTHORITATIVE_INFORMATION,
        self::CODE_204_NO_CONTENT                    => self::MESSAGE_204_NO_CONTENT,
        self::CODE_205_RESET_CONTENT                 => self::MESSAGE_205_RESET_CONTENT,
        self::CODE_206_PARTIAL_CONTENT               => self::MESSAGE_206_PARTIAL_CONTENT,

        // 3XX Redirect

        self::CODE_300_MULTIPLE_CHOICES   => self::MESSAGE_300_MULTIPLE_CHOICES,
        self::CODE_301_MOVED_PERMANENTLY  => self::MESSAGE_301_MOVED_PERMANENTLY,
        self::CODE_302_FOUND              => self::MESSAGE_302_FOUND,
        self::CODE_303_SEE_OTHER          => self::MESSAGE_303_SEE_OTHER,
        self::CODE_304_NOT_MODIFIED       => self::MESSAGE_304_NOT_MODIFIED,
        self::CODE_305_USE_PROXY          => self::MESSAGE_305_USE_PROXY,
        self::CODE_306_SWITCH_PROXY       => self::MESSAGE_306_SWITCH_PROXY, // @deprecated
        self::CODE_307_TEMPORARY_REDIRECT => self::MESSAGE_307_TEMPORARY_REDIRECT,

        // 4XX Client error

        self::CODE_400_BAD_REQUEST                     => self::MESSAGE_400_BAD_REQUEST,
        self::CODE_401_UNAUTHORIZED                    => self::MESSAGE_401_UNAUTHORIZED,
        self::CODE_402_PAYMENT_REQUIRED                => self::MESSAGE_402_PAYMENT_REQUIRED,
        self::CODE_403_FORBIDDEN                       => self::MESSAGE_403_FORBIDDEN,
        self::CODE_404_NOT_FOUND                       => self::MESSAGE_404_NOT_FOUND,
        self::CODE_405_METHOD_NOT_ALLOWED              => self::MESSAGE_405_METHOD_NOT_ALLOWED,
        self::CODE_406_NOT_ACCEPTABLE                  => self::MESSAGE_406_NOT_ACCEPTABLE,
        self::CODE_407_PROXY_AUTHENTICATION_REQUIRED   => self::MESSAGE_407_PROXY_AUTHENTICATION_REQUIRED,
        self::CODE_408_REQUEST_TIMEOUT                 => self::MESSAGE_408_REQUEST_TIMEOUT,
        self::CODE_409_CONFLICT                        => self::MESSAGE_409_CONFLICT,
        self::CODE_410_GONE                            => self::MESSAGE_410_GONE,
        self::CODE_411_LENGTH_REQUIRED                 => self::MESSAGE_411_LENGTH_REQUIRED,
        self::CODE_412_PRECONDITION_FAILED             => self::MESSAGE_412_PRECONDITION_FAILED,
        self::CODE_413_REQUEST_ENTITY_TOO_LARGE        => self::MESSAGE_413_REQUEST_ENTITY_TOO_LARGE,
        self::CODE_414_REQUEST_URI_TOO_LONG            => self::MESSAGE_414_REQUEST_URI_TOO_LONG,
        self::CODE_415_UNSUPPORTED_MEDIA_TYPE          => self::MESSAGE_415_UNSUPPORTED_MEDIA_TYPE,
        self::CODE_416_REQUESTED_RANGE_NOT_SATISFIABLE => self::MESSAGE_416_REQUESTED_RANGE_NOT_SATISFIABLE,
        self::CODE_417_EXPECTATION_FAILED              => self::MESSAGE_417_EXPECTATION_FAILED,

        // 5XX Server error

        self::CODE_500_INTERNAL_SERVER_ERROR      => self::MESSAGE_500_INTERNAL_SERVER_ERROR,
        self::CODE_501_NOT_IMPLEMENTED            => self::MESSAGE_501_NOT_IMPLEMENTED,
        self::CODE_502_BAD_GATEWAY                => self::MESSAGE_502_BAD_GATEWAY,
        self::CODE_503_SERVICE_UNAVAILABLE        => self::MESSAGE_503_SERVICE_UNAVAILABLE,
        self::CODE_504_GATEWAY_TIMEOUT            => self::MESSAGE_504_GATEWAY_TIMEOUT,
        self::CODE_505_HTTP_VERSION_NOT_SUPPORTED => self::MESSAGE_505_HTTP_VERSION_NOT_SUPPORTED,
    ];

    /**
     * @var array
     */
    protected static $statuses;

    /**
     * Returns status message for the specified status code.
     *
     * @param string $code
     * @return string
     */
    public static function getMessage($code)
    {
        return isset(static::$messagesByCode[$code]) ? static::$messagesByCode[$code] : null;
    }

    /**
     * @param bool $combined
     * @return array
     */
    public static function getCodes($combined = false)
    {
        if (!isset(static::$codes, static::$combinedCodes)) {
            $codes         = [];
            $combinedCodes = [];

            foreach (static::getValues() as $key => $value) {
                if (substr($key, 0, 5) === 'CODE_') {
                    $codes[$key]           = $value;
                    $combinedCodes[$value] = $value;
                }
            }

            static::$codes         = $codes;
            static::$combinedCodes = $combinedCodes;
        }

        return $combined ? static::$combinedCodes : static::$codes;
    }

    /**
     * @param bool $combined
     * @return array
     */
    public static function getMessages($combined = false)
    {
        if (!isset(static::$messages, static::$combinedMessages)) {
            $messages         = [];
            $combinedMessages = [];

            foreach (static::getValues() as $key => $value) {
                if (substr($key, 0, 5) === 'MESSAGE_') {
                    $messages[$key]           = $value;
                    $combinedMessages[$value] = $value;
                }
            }

            static::$messages         = $messages;
            static::$combinedMessages = $combinedMessages;
        }

        return $combined ? static::$combinedMessages : static::$messages;
    }
}