<?php

namespace Digikraaft\Mono\ApiOperations;

trait Fetch
{
    use Request;
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
