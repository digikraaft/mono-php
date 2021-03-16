<?php


    namespace Digikraaft\Mono;

    class Payment extends ApiResource
    {
        const OBJECT_NAME = 'payments';

        /**
         * @param array $params
         * @return array|object
         * @throws Exceptions\InvalidArgumentException
         * @throws Exceptions\IsNullException
         * @link https://docs.mono.co/reference#initiate-payment
         */
        public static function initiate(array $params)
        {
            $url = self::endPointUrl("initiate");

            return self::staticRequest('POST', $url, $params);
        }

        /**
         * @param string $paymentId
         * @return array|object
         * @throws Exceptions\InvalidArgumentException
         * @throws Exceptions\IsNullException
         * @link https://docs.mono.co/reference#pull-status
         */
        public static function onetimeDebitStatus(string $paymentId)
        {
            $url = self::endPointUrl("debits/{$paymentId}");

            return self::staticRequest('GET', $url);
        }

        public static function recurringDebitStatus(string $paymentId)
        {
            $url = self::endPointUrl("recurring-debits/{$paymentId}");

            return self::staticRequest('GET', $url);
        }
    }
