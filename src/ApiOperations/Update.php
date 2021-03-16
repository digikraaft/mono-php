<?php

namespace Digikraaft\Paystack\ApiOperations;

trait Update
{
    /**
     * @param string $id     Resource id
     * @param array  $params
     *
     * @return array|object
     */
    public static function update(string $id, $params)
    {
        self::validateParams($params, true);
        $url = static::resourceUrl($id);

        return static::staticRequest('PUT', $url, $params);
    }
}
