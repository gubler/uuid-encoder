<?php

declare(strict_types=1);

namespace Gubler\UuidEncoder\Tests;

use PHPUnit\Framework\TestCase;
use Gubler\UuidEncoder\UuidEncoder;
use Ramsey\Uuid\Uuid;

class UuidEncoderTest extends TestCase
{
    private $tool;

    public function setUp(): void
    {
        $this->tool = new UuidEncoder();
    }

    public function testCanParseUuidString(): void
    {
        $string = '00000000-0000-4000-8000-000000000000';
        $uuid = $this->tool->parse($string);
        $this->assertSame($string, $uuid->toString());

    }

    public function testCanParseUuid(): void
    {
        $source = Uuid::uuid4();
        $uuid = $this->tool->parse($source);
        $this->assertSame($source, $uuid);
    }

    public function testCanEncodeFromUuidWithDefaultCharset(): void
    {
        $expected = 'sP8IoTNzOC2MA';
        $source = Uuid::fromString('00000000-0000-4000-8000-000000000000');

        $actual = $this->tool->encode($source);
        $this->assertSame($expected, $actual);
    }

    public function testCanDecodeWithDefaultCharset(): void
    {
        $source = 'sP8IoTNzOC2MA';
        $expected = Uuid::fromString('00000000-0000-4000-8000-000000000000');

        $actual = $this->tool->decode($source);
        $this->assertEquals($expected, $actual);
    }
}
