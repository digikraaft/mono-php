<?php

namespace Digikraaft\Mono\Tests;

use Digikraaft\Mono\Exceptions\InvalidArgumentException;
use Digikraaft\Mono\Mono;
use Mockery as mk;
use PHPUnit\Framework\TestCase;

class Mock extends TestCase
{
    protected $mono;
    protected $mock;

    public function setUp(): void
    {
        TestHelper::setup();
        $this->mono = mk::mock('Digikraaft\Mono\Mono');
        $this->mock = mk::mock('GuzzleHttp\Client');
    }

    /** @test */
    public function it_returns_instance_of_mono_ng()
    {
        $this->assertInstanceOf("Digikraaft\Mono\Mono", $this->mono);
    }

    /** @test */
    public function it_returns_invalid_api_key()
    {
        $this->expectException(InvalidArgumentException::class);
        Mono::setSecretKey('');
    }

    /** @test */
    public function it_returns_api_key()
    {
        Mono::setSecretKey('sk_apikey');
        $this->assertIsString(Mono::getSecretKey());
    }
}
