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
            if (is_array($links) || is_object($links)){
                foreach($links as $link){
                    $this->queue->enqueue($link);
                }
            }
            
        }
    }

    public function setMaxDepth(int $newDepth)
    {
        $this->maxDepth = $newDepth;
    }

    public function getMaxDepth()
    {
        return $this->maxDepth;
    }

    public function getCrawledPages()
    {
        return $this->crawledPages;
    }
    
}