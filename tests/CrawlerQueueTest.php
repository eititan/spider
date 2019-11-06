<?php
/**
 * Tests for CrawlerQueue
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
use App\crawl\CrawlerQueue;

class CrawlerQueueTest extends TestCase
{
    private $queue;
    /**
     * Set up data needed for every unit-test
     */
    public function setUp(): void
    {
        $this->queue = new CrawlerQueue();
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
     * Tests if queue is empty works
     * @return   void
     */
    public function testIsEmpty(): void
    {
        $expected = true;
        $actual = $this->queue->isEmpty();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

     /**
     * Tests if is empty after enqueue'ing
     * @return   void
     */
    public function testIsNotEmpty(): void
    {
        $this->queue->enqueue("first");
        $expected = false;
        $actual = $this->queue->isEmpty();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

     /**
     * Tests if is empty after enqueue'ing
     * @return   void
     */
    public function testEnqueue(): void
    {
        $this->queue->enqueue("first");
        $this->queue->enqueue("second");
        $this->queue->enqueue("third");

        $expected = false;
        $actual = $this->queue->isEmpty();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

    /**
     * Tests if is empty after enqueue'ing
     * @return   void
     */
    public function testDequeue(): void
    {
        $this->queue->enqueue("first");
        $expected = "first";
        $actual = $this->queue->dequeue();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

    public function testDequeueNull(): void
    {
        $expected = null;
        $actual = $this->queue->dequeue();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

     /**
     * Tests if is empty after enqueue'ing
     * @return   void
     */
    public function testFIFO(): void
    {
        $this->queue->enqueue("first");
        $this->queue->enqueue("second");
        $this->queue->enqueue("third");

        $expected = "first";
        $actual = $this->queue->dequeue();
        $this->assertEquals($expected, $actual,  "actual value is not equals to expected");
    }

}
