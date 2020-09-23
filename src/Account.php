<?php

namespace Digikraaft\Mono;

class Account extends ApiResource
{
    const OBJECT_NAME = 'accounts';

    /**
     * @param string $authCode
     *
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://www.notion.so/API-endpoints-b75e32f64c75471ab5fbcc61927f6679
     */
    public static function auththenticate(string $authCode)
    {
        $url = static::endPointUrl("auth");

        return static::staticRequest('POST', $url, ['code' => $authCode]);
    }

    /**
     * @param string $id
     *
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://www.notion.so/API-endpoints-b75e32f64c75471ab5fbcc61927f6679
     */
    public static function fetchStatement(string $id)
    {
        $url = static::endPointUrl("{$id}/statement");

        return static::staticRequest('GET', $url);
    }

    /**
     * @param string $id
     * @param array  $filters
     *
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://www.notion.so/API-endpoints-b75e32f64c75471ab5fbcc61927f6679
     */
    public static function listTransactions(string $id, array $filters)
    {
        $url = static::buildQueryString("{$id}/transactions", $filters);

        return static::staticRequest('GET', $url);
    }

    /**
     * @param string $id
     *
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://www.notion.so/API-endpoints-b75e32f64c75471ab5fbcc61927f6679
     */
    public static function listCredits(string $id)
    {
        $url = static::buildQueryString("{$id}/credits");

        return static::staticRequest('GET', $url);
    }

    /**
     * @param string $id
     *
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://www.notion.so/API-endpoints-b75e32f64c75471ab5fbcc61927f6679
     */
    public static function listDebits(string $id)
    {
        $url = static::buildQueryString("{$id}/debits");

        return static::staticRequest('GET', $url);
    }
}
