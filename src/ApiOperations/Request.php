<?php

namespace Digikraaft\Mono\ApiOperations;

use Digikraaft\Mono\Exceptions\ApiErrorException;
use Digikraaft\Mono\Exceptions\InvalidArgumentException;
use Digikraaft\Mono\Exceptions\IsNullException;
use Digikraaft\Mono\Mono;
use Digikraaft\Mono\Util\Util;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Trait for resources that need to make API requests.
 */
trait Request
{
    /**
     * Instance of Client.
     */
    protected static $client;

    /**
     *  Response from requests made to Mono.
     *
     * @var mixed
     */
    protected static $response;

    /**
     * @param null|array|mixed $params   The list of parameters to validate
     * @param bool             $required
     *
     * @throws InvalidArgumentException if $params exists and is not an array
     */
    public static function validateParams($params = null, $required = false): void
    {
        if ($required) {
            if (empty($params) || ! is_array($params)) {
                $message = 'The parameter passed must be an array and must not be empty';

                throw new InvalidArgumentException($message);
            }
        }
        if ($params && ! is_array($params)) {
            $message = 'The parameter passed must be an array';

            throw new InvalidArgumentException($message);
        }
    }

    /**
     * @param string $method      HTTP method ('get', 'post', etc.)
     * @param string $url         URL for the request
     * @param array  $params      list of parameters for the request
     * @param string $return_type return array or object accepted values: 'arr' and 'obj'
     *
     * @throws InvalidArgumentException
     * @throws IsNullException
     *
     * @return array|object (the JSON response as array or object)
     */
    public static function staticRequest($method, $url, $params = [], $return_type = 'obj')
    {
        if ($return_type != 'arr' && $return_type != 'obj') {
            throw new InvalidArgumentException('Return type can only be obj or arr');
        }
        static::setHttpResponse($method, $url, $params);

        if ($return_type == 'arr') {
            return static::getResponseData();
        }

        return Util::convertArrayToObject(static::getResponse());
    }

    /**
     * Set options for making the Client request.
     */
    protected static function setRequestOptions(): void
    {
        $authBearer = 'Bearer '.Mono::getSecretKey();

        static::$client = new Client(
            [
                'base_uri' => Mono::$apiBaseUrl,
                'headers' => [
                    'Authorization' => $authBearer,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
            ]
        );
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $body
     *
     * @throws IsNullException
     * @throws ApiErrorException
     */
    private static function setHttpResponse($method, $url, $body = []): \GuzzleHttp\Psr7\Response
    {
        if (is_null($method)) {
            throw new IsNullException('Empty method not allowed');
        }

        static::setRequestOptions();

        try {
            static::$response = static::$client->{strtolower($method)}(
                Mono::$apiBaseUrl . '/' . $url,
                ['body' => json_encode($body)]
            );

            return static::$response;
        } catch (ClientException $exception) {
            throw new ApiErrorException($exception->getMessage());
        }
    }

    /**
     * Get the data response from an API operation.
     *
     * @return array
     */
    private static function getResponse(): array
    {
        return json_decode(static::$response->getBody(), true);
    }

    /**
     * Get the data response from a get operation.
     *
     * @return array
     */
    private static function getResponseData(): array
    {
        return json_decode(static::$response->getBody(), true)['data'];
    }
}
