<?php

namespace Digikraaft\OpenBankingNg\Tests;

use Digikraaft\OpenBankingNg\Exceptions\InvalidArgumentException;
use Digikraaft\OpenBankingNg\Util\Util;
use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase
{
    /** @test */
    public function test_utf8()
    {
        // UTF-8 string
        $x = "\xc3\xa9";
        static::assertSame(Util::utf8($x), $x);

        // Latin-1 string
        $x = "\xe9";
        static::assertSame(Util::utf8($x), "\xc3\xa9");

        // Not a string
        $x = true;
        static::assertSame(Util::utf8($x), $x);
    }

    /** @test */
    public function it_can_convert_array_to_objects()
    {
        $obj = Util::convertArrayToObject(['data' => 'Digikraaft']);
        $this->assertEquals('object', gettype($obj));
    }

    /** @test */
    public function it_can_convert_nested_array_to_objects()
    {
        $obj = Util::convertArrayToObject([
            'data' => [
                'first_name' => 'Digikraaft',
            ],
        ]);
        $this->assertEquals('object', gettype($obj));
    }

    /** @test */
    public function it_can_return_exception_for_non_array_parameters()
    {
        $this->expectException(InvalidArgumentException::class);
        Util::convertArrayToObject('');
    }
}
