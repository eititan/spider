<?php

namespace App\Crawler;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Request;
use App\Crawler\PageParser;

/**
 * Takes in the initial url and starts crawl
 */

class Crawler {
    
    /**
     * @var String
     */
    private $url;

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
    private $maxDepth;

    /**
     * Array of PageParser objects
     *
     * @var array
     */
    private $crawledPages;

    public function __construct(String $crawlUrl) {
        $this->url = $crawlUrl;
        $this->spinWeb();
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

    private function getDelayBetweenRequests(int $delay)
    {
        return $this->delayBetweenRequests;
    }

    private function spinWeb(){
        $client = new Client();
        $this->response = $client->get($this->url);
        $page = new PageParser($this->response);

    }
    
}