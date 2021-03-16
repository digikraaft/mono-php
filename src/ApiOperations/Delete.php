<?php

namespace Digikraaft\Mono\ApiOperations;

trait Delete
{
    use Request;

    /**
     * @param string $id Resource id
     * @return array|object
     * @throws \Digikraaft\Mono\Exceptions\InvalidArgumentException
     * @throws \Digikraaft\Mono\Exceptions\IsNullException
     */
    public static function delete(string $id)
    {
        $url = self::resourceUrl($id);

        return static::staticRequest('DELETE', $url);
    }
}
