<?php 

namespace App\Crawler;

use GuzzleHttp\Psr7\Response;

class PageParser {

    private $url;
    private $rawBody;
    private $title;
    private $text;
    private $statusCode;
    private $links;
    private $dom;
    
    public function __construct(Response $response, String $url) {
        $this->dom = new \DOMDocument('1.0', 'UTF-8');
        $this->url = $url;
        $this->rawBody = $response->getBody(true);
        $this->statusCode = $response->getStatusCode();

        $this->parseBodyForTitle();
        $this->parseBodyForText();
        $this->parseBodyForURLs();
    }

    private function parseBodyForTitle(){
        $internalErrors = libxml_use_internal_errors(true);
        $this->dom->loadHTML($this->rawBody);
        $this->title = $this->dom->getElementsByTagName("title");

        if($this->title->length > 0){
            $this->title = $this->title->item(0)->textContent;
            //echo $this->title;
        }
    }

    private function parseBodyForText(){
        $this->dom->loadHTML($this->rawBody);
        $tags = $this->dom->getElementsByTagName("body");
        $this->text = $tags->item(0)->textContent;

        // echo $this->text;
    }

    private function parseBodyForURLs(){
        $internalErrors = libxml_use_internal_errors(true);
        $this->dom->loadHTML($this->rawBody);
      
        foreach ($this->dom->getElementsByTagName('a') as $node) {
            if($node->hasAttribute('href')){
                $this->isValidURL($node->getAttribute('href'));
            }
        }
        libxml_use_internal_errors($internalErrors);

        // $links = $this->dom->getElementsByTagName('a');
        // $numLinks = $links->length;
        // echo $numLinks;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getBody(){
        return $this->body;
    }

    public function getLinks(){
        return $this->links;
    }

    public function getStatusCode(){
        return $this->statusCode;
    }

    private function isValidURL(String $url){
        $url = filter_var($url, FILTER_SANITIZE_URL);

        if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
            $this->links[] = $url;
        } 
    }

}