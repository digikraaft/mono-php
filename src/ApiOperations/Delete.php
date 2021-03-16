<?php

namespace Digikraaft\Mono\ApiOperations;

trait Update
{
    use Request;
    /**
     * @param string $id     Resource id
     * @param array  $params
     *
     * @return array|object
     */
    public static function update(string $id, $params)
    {
        self::validateParams($params, true);
        $url = self::resourceUrl($id);

        return static::staticRequest('PUT', $url, $params);
    }
}
