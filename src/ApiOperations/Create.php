<?php

namespace Digikraaft\Mono\ApiOperations;

trait Create
{
    use Request;
    /**
     * @param array $params
     *
     * @return array|object
     */
    public static function create($params)
    {
        self::validateParams($params, true);
        $url = static::classUrl();

        return static::staticRequest('POST', $url, $params);
    }
}
