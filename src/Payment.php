<?php


    namespace Digikraaft\Mono;


    class Wallet extends ApiResource
    {
        /**
         * @return array|object
         * @throws Exceptions\InvalidArgumentException
         * @throws Exceptions\IsNullException
         * @link https://docs.mono.co/reference#fetch-balance
         */
        public static function balance()
        {
            $url = "users/stats/wallet";

            return static::staticRequest('GET', $url);
        }
    }
