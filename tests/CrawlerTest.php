<?php
/**
 * Tests for Crawler
 *
 * PHP Version 7
 *
 * @category UnitTests
 * @package  Tests
 * @author  John Hutchins
 */
declare(strict_types=1);
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\crawl\Crawler;

class CrawlerTest extends TestCase
{
    private $crawler;
    /**
     * Set up data needed for every unit-test
     */
    public function setUp(): void
    {
        $this->crawler = new Crawler("google.com");
    }

    /**
     * Tests if unit-test can be run
     *
     * @category UnitTests
     * @package  App\Tests
     * @return   void
     */
    public function testCanary(): void
    {
        // arrange & act & assert
        $this->assertTrue(true);
    }
    
}