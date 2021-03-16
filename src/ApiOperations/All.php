<?php

namespace Digikraaft\Paystack\ApiOperations;

trait All
{
    /**
     * @param null|array $params query parameters
     *
     * @return array|object
     */
    public static function list($params = null)
    {
        self::validateParams($params);
        $url = static::classUrl();
        if (! empty($params)) {
            $url .= '?'.http_build_query($params);
        }

        return static::staticRequest('GET', $url);
    }
}
