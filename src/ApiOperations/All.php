<?php

namespace Digikraaft\Mono\ApiOperations;

trait All
{
    use Request;

    /**
     * @param null|array $params query parameters
     *
     * @return array|object
     * @throws \Digikraaft\Mono\Exceptions\InvalidArgumentException
     * @throws \Digikraaft\Mono\Exceptions\IsNullException
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
