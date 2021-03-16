<?php

namespace Digikraaft\Mono\ApiOperations;

trait Update
{
    use Request;

    /**
     * @param string $id
     * @param $params
     * @return array|object
     * @throws \Digikraaft\Mono\Exceptions\InvalidArgumentException
     * @throws \Digikraaft\Mono\Exceptions\IsNullException
     */
    public static function update(string $id, $params)
    {
        self::validateParams($params, true);
        $url = resourceUrl($id);

        return static::staticRequest('PUT', $url, $params);
    }
}
