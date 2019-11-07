<?php

namespace App\Crawler;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Request;
use App\Crawler\PageParser;
use App\Crawler\CrawlerQueue;

/**
 * Takes in the initial url and starts crawl
 */

class Crawler {

    /**
     * set the delay between http requests
     *
     * @var integer
     */
    private $delayBetweedRequests = 1;

    /**
     * max depth desired for search
     *
     * @var int
     */
    private $maxDepth = 5;

    /**
     * Array of PageParser objects
     *
     * @var array of PageParser
     */
    private $crawledPages;

    /**
     * CrawlerQueue object
     *
     * @var CrawlerQueue
     */
    private $queue;

    public function __construct(String $startUrl) {
        $this->queue = new CrawlerQueue();
        $this->queue->enqueue($startUrl);
        $this->spinWeb();
    }

    private function spinWeb(){
        $client = new Client();

        for ($i=0; $i < $this->maxDepth; $i++) { 
            if($this->queue->isEmpty()){
                return;
            }
            
            $url = $this->queue->dequeue();
            $this->response = $client->get($url);
            $page = new PageParser($this->response, $url);
            $this->crawledPages[] = $page;

            $links = $page->getLinks();
            foreach($links as $link){
                $this->queue->enqueue($link);
            }
        }
    }

    /**
     * @param int $delay The delay in milliseconds.
     *
     * @return int
     */
    private function setDelayBetweenRequests(int $delay)
    {
        $this->delayBetweenRequests = ($delay * 1000);
    }

    public function getDelayBetweenRequests(int $delay)
    {
        return $this->delayBetweenRequests;
    }

    public function getCrawledPages()
    {
        return $this->crawledPages;
    }
    
}