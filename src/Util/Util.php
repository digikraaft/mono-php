<?php

namespace Digikraaft\Mono\Util;

use Digikraaft\Mono\Exceptions\InvalidArgumentException;
use stdClass;

abstract class Util
{
    private static $isMbstringAvailable = null;
    private static $isHashEqualsAvailable = null;

    /**
     * @param mixed|string $value a string to UTF8-encode
     *
     * @return mixed|string the UTF8-encoded string, or the object passed in if
     *                      it wasn't a string
     */
    public static function utf8($value)
    {
        if (null === self::$isMbstringAvailable) {
            self::$isMbstringAvailable = function_exists('mb_detect_encoding');

            if (! self::$isMbstringAvailable) {
                trigger_error('It looks like the mbstring extension is not enabled. '.
                    'UTF-8 strings will not properly be encoded. Ask your system '.
                    'administrator to enable the mbstring extension.', E_USER_WARNING);
            }
        }

        if (is_string($value) && self::$isMbstringAvailable && 'UTF-8' !== mb_detect_encoding($value, 'UTF-8', true)) {
            return utf8_encode($value);
        }

        return $value;
    }

    /**
     * Converts a response from the Flutterwave API to the corresponding PHP object.
     *
     * @param array $resp the response from the Flutterwave API
     *
     * @return array|object
     */
    public static function convertArrayToObject($resp)
    {
        if (! is_array($resp)) {
            $message = 'The response passed must be an array';

            throw new InvalidArgumentException($message);
        }

        $object = new stdClass();

        return self::arrayToObject($resp, $object);
    }

    private static function arrayToObject($array, &$obj)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $obj->$key = new stdClass();
                self::arrayToObject($value, $obj->$key);
            } else {
                $obj->$key = $value;
            }
        }

        return $obj;
    }
}
