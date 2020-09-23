<?php

namespace Digikraaft\OpenBankingNg\Tests;

use Digikraaft\OpenBankingNg\ApiResource;
use Digikraaft\OpenBankingNg\Exceptions\InvalidArgumentException;
use Mockery as mk;
use PHPUnit\Framework\TestCase;

class ApiResourceTest extends TestCase
{
    protected $mock;

    public function setUp(): void
    {
        $this->mock = mk::mock('GuzzleHttp\Client');
    }

    /** @test  * */
    public function it_returns_endpoint_url()
    {
        $url = ApiResource::endPointUrl('digikraaft');
        $this->assertIsString($url);
    }

    /** @test * */
    public function it_returns_exception_for_null_resource_id()
    {
        $this->expectException(InvalidArgumentException::class);
        ApiResource::resourceUrl(null);
    }

    /** @test  * */
    public function it_returns_resource_url()
    {
        $url = ApiResource::resourceUrl('cus_1234');
        $this->assertIsString($url);
    }

    /** @test  * */
    public function it_returns_class_url()
    {
        $url = ApiResource::classUrl();
        $this->assertIsString($url);
    }

    /** @test  * */
    public function it_returns_base_url()
    {
        $url = ApiResource::baseUrl();
        $this->assertIsString($url);
    }
}
