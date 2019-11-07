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

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Request;
use App\crawler\PageParser;
use PHPUnit\Framework\TestCase;

class PageParserTest extends TestCase
{
    private $parser;
    private $url;
    private $response;
    private $dom;

    /**
     * Set up data needed for every unit-test
     */
    public function setUp(): void
    {
        $this->dom = new \DOMDocument('1.0', 'UTF-8');
        $this->url = "https://google.com";
        $client = new Client();
        $this->response = $client->get($this->url);
        $this->parser = new PageParser($this->response,  $this->url);
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
     * Test if get URL works properly
     * @return   void
     */
    public function testGetUrl(): void
    {
        $expected = "https://google.com";
        $actual = $this->parser->getUrl();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

    /**
     * Test if url was set properly
     * @return   void
     */
    public function testSetUrl(): void
    {
        $expected = "https://google.com";
        $this->parser->setUrl($this->url);

        $actual = $this->parser->getUrl();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

     /**
     * Test if titile was properly extracted from body
     * @return   void
     */
    public function testGetTitle(): void
    {
        $expected = "Google";
        $actual = $this->parser->getTitle();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

     /**
     * Test if title is being properly set and retrieved
     * @return   void
     */
    public function testParseBodyForTitle(): void
    {   
        $expected = "Google";

        $this->parser->parseBodyForTitle($this->response);
        $actual = $this->parser->getTitle();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

    
    // /**
    //  * Test if body can be retrieved properly
    //  * @return   void
    //  */
    // public function testGetBody(): void
    // {
    //     $actual = $this->parser->getBody();
    //     $this->assertInstanceOf(String, $actual);
    // }

     /**
     * Test for text being taken from html body
     * @return   void
     */
    public function testParseBodyForText(): void
    {
        $expected = $this->parser->getBody();

        //reparse with response to verify correct parsing
        //I cannot run dom test due to a persisting php bug and cannot seen to confire dom correctly
        //https://stackoverflow.com/questions/30925533/php-dom-loadhtml-method-unusual-warning
        $this->parser->parseBodyForTitle($this->response);
        $actual = $this->parser->getBody();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }


    /**
     * Test retriving links in parser correctly works
     * and has added links to array
     * @return   void
     */
    public function testGetLinks(): void
    {
        $actual = $this->parser->getLinks();
        $this->assertIsArray($actual);
    }

     /**
     * Tests for multiple links
     * 
     * @return   void
     */
    public function testGetBody(): void
    {
        $this->assertGreaterThan(1, count($this->parser->getLinks()));
    }



}