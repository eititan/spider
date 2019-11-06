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
    /**
     * Set up data needed for every unit-test
     */
    public function setUp(): void
    {
        $client = new Client();
        $this->response = $client->get("https://google.com");
        $this->parser = new PageParser($this->response);
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