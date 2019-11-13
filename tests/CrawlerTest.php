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
use App\crawler\Crawler;
use App\crawler\PageParser;

class CrawlerTest extends TestCase
{
    private $crawler;
    /**
     * Set up data needed for every unit-test
     */
    public function setUp(): void
    {
        $this->crawler = new Crawler("https://google.com");
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

    /**
     * Tests if getting max depth works
     * @return   void
     */
    public function testGetMaxDepth(): void
    {
        //5 is default min
        $expected = 5;
        $actual = $this->crawler->getMaxDepth();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

    /**
     * Tests setting max depth works
     * @return   void
     */
    public function testSetMaxDepth(): void
    {
        $this->crawler->setMaxDepth(13);
        $expected = 13;
        $actual = $this->crawler->getMaxDepth();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

   /**
     * Test if number of pages matches max depth
     * @return   void
     */
    public function testGetCrawledPagesMatchesDepth(): void
    {
        $expected = 5;
        $actual = count($this->crawler->getCrawledPages());
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

    /**
     * Test that getCrawled holds PageParser types
     * @return   void
     */
    public function testGetCrawledPagesIsPageParser(): void
    {
        $pages = $this->crawler->getCrawledPages();
        $page = $pages[0];

        $expected = PageParser::class;
        $actual = $page;
        $this->assertInstanceOf($expected, $actual);
    }

    
//    /**
//      * Tests setting max depth works
//      * @return   void
//      */
//     public function testSpinWeb(): void
//     {
//        //test spinWeb
//     }

}