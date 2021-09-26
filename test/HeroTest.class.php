<?php
declare(strict_types=1);
/**
 * Test Hero
 * Bogdana Vicol 
 * 
 */
include '../include/autoloader.inc.php';
use PHPUnit\Framework\TestCase;

/**
 * Class HeroTest  
 */
final class HeroTest extends TestCase
{

    public function testFailure(): void
    {
        $this->assertStringContainsString('hero', 'beast');
    }

    public function testSetAndGet(): void
    {
        $stack = [];
        $this->assertSame(0, count($stack));

        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertSame(1, count($stack));

        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));
    }
}
