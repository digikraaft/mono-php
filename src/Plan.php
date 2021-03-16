<?php


    namespace Digikraaft\Mono;

    use Digikraaft\Mono\ApiOperations\Create;
    use Digikraaft\Mono\ApiOperations\Delete;
    use Digikraaft\Mono\ApiOperations\Update;

    class Plan extends ApiResource
    {
        const OBJECT_NAME = 'plans';

        use Create;
        use Update;
        use Delete;

        /**
         * @return array|object
         * @throws Exceptions\InvalidArgumentException
         * @throws Exceptions\IsNullException
         * @link https://docs.mono.co/reference#list-plans
         */
        public static function list()
        {
            $url = "payments/plans";

            return static::staticRequest('GET', $url);
        }
    }
