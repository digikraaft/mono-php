<?php

namespace Digikraaft\Mono;

use Digikraaft\Mono\Util\Util;

class Account extends ApiResource
{
    const OBJECT_NAME = 'accounts';

    /**
     * @param string $authCode
     *
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://docs.mono.co/reference#authentication-endpoint
     */
    public static function authenticate(string $authCode)
    {
        $url = "account/auth";

        return static::staticRequest('POST', $url, ['code' => $authCode]);
    }

    /**
     * @param string $accountId
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://docs.mono.co/reference#bank-account-details
     */
    public static function details(string $accountId)
    {
        $url = self::endPointUrl("{$accountId}");

        return self::staticRequest('GET', $url);
    }

    /**
     * @param string $accountId
     * @param array $filters
     *
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://docs.mono.co/reference#bank-statement
     */
    public static function fetchStatement(string $accountId, array $filters)
    {
        Util::validateData(['period'], $filters);
        $url = static::buildQueryString("{$accountId}/statement", $filters);

        return static::staticRequest('GET', $url);
    }

    /**
     * @param string $accountId
     * @param string $jobId
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://docs.mono.co/reference#poll-statement-status
     */
    public static function pollStatementPdfStatus(string $accountId, string $jobId)
    {
        $url = self::endPointUrl("{$accountId}/statement/jobs/$jobId");

        return static::staticRequest('GET', $url);
    }

    /**
     * @param string $accountId
     * @param array|null $filters
     *
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://docs.mono.co/reference#transactions
     */
    public static function listTransactions(string $accountId, ?array $filters = null)
    {
        $url = static::buildQueryString("{$accountId}/transactions", $filters);

        return static::staticRequest('GET', $url);
    }

    /**
     * @param string $accountId
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://docs.mono.co/reference#income
     */
    public static function income(string $accountId)
    {
        $url = static::endPointUrl("{$accountId}/income");

        return static::staticRequest("GET", $url);
    }

    /**
     * @param string $accountId
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://docs.mono.co/reference#identity
     */
    public static function identity(string $accountId)
    {
        $url = static::endPointUrl("{$accountId}/identity");

        return static::staticRequest("GET", $url);
    }

    /**
     * @param string $accountId
     * @param array $params
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://docs.mono.co/reference#manually-trigger
     */
    public static function sync(string $accountId, ?array $params = null)
    {
        $url = static::endPointUrl("{$accountId}/sync");

        return static::staticRequest("POST", $url, $params);
    }

    /**
     * @param string $accountId
     * @param array|null $params
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://docs.mono.co/reference#reauth-code
     */
    public static function reauthorise(string $accountId, ?array $params = null)
    {
        $url = static::endPointUrl("{$accountId}/reauthorise");

        return static::staticRequest("POST", $url, $params);
    }

    /**
     * @param null $params
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://docs.mono.co/reference#bvnlookup
     */
    public static function bvnLookup($params = null)
    {
        $url = "lookup/bvn/identity";

        return static::staticRequest('POST', $url, $params);
    }

    /**
     * @param string $accountId
     * @param array|null $params
     * @return array|object
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\IsNullException
     * @link https://docs.mono.co/reference#unlink-account
     */
    public static function unlink(string $accountId, ?array $params = null)
    {
        $url = static::endPointUrl("{$accountId}/unlink");

        return static::staticRequest("POST", $url, $params);
    }
}
