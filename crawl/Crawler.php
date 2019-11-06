<?php

namespace App\Crawl;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Request;
use App\Crawl\PageParser;

/**
 * Takes in the initial url and starts crawl
 */

class Crawler {

    private $url;

    private $delayBetweedRequests = 1;

    /**
     * Varible for max depth for search
     *
     * @var int
     */
    private $maxDepth;

    private $response;

    private $body;
    private $crawledPages;

    public function __construct(String $crawlUrl) {
        $this->url = $crawlUrl;
        $this->spinWeb();
    }

    /**
     * @param int $delay The delay in milliseconds.
     *
     * @return 
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

    public function getResponse(){
        return $this->response;
    }
    public function getResponseBody(){
        return $this->body;
    }

    
}