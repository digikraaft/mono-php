<?php

namespace Digikraaft\Paystack\ApiOperations;

trait Fetch
{
    /**
     * @param string $id Resource id
     *
     * @return array|object
     */
    public static function fetch(string $id)
    {
        $url = static::resourceUrl($id);

        return static::staticRequest('GET', $url);
    }
}
