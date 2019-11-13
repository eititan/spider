<?php 

namespace App\Crawler;

use GuzzleHttp\Psr7\Response;

/**
 * PageParser deals with all of the response logic 
 * It takes in a response and parses desired information about
 * that page that was requested by the crawler
 */
class PageParser {


    /**
     * the url that is associated with this page
     *
     * @var String
     */
    private $url;

    /**
     * title of the webpage
     *
     * @var String
     */
    private $title;

    /**
     * raw text from html contents
     *
     * @var String
     */
    private $text;

    /**
     * status code that was generated when we requested web page
     *
     * @var String
     */
    private $statusCode;

    /**
     * List of all the hrefs found in this web page
     *
     * @var String Array
     */
    private $links;

    /**
     * Number of links found
     *
     * @var int
     */
    private $numLinks;

    /**
     * Number of characters desired in the body
     *
     * @var int
     */
    private $bodyLength = 512;

    /**
     * DOMDocument object for extracting info from html body
     *
     * @var DOMDocument
     */
    private $dom;
    
    public function __construct(Response $response, String $url) {
        $this->dom = new \DOMDocument('1.0', 'UTF-8');
    
        $this->parseBodyForTitle($response);
        $this->parseBodyForText($response);
        $this->parseBodyForURLs($response);
        $this->setUrl($url);
        $this->setStatusCode($response);
    }

    public function parseBodyForTitle(Response $response){
        $internalErrors = libxml_use_internal_errors(true);
        $this->dom->loadHTML($response->getBody());
        $this->title = $this->dom->getElementsByTagName("title");

        if($this->title->length > 0){
            $this->title = $this->title->item(0)->textContent;
        }
    }

    public function parseBodyForText(Response $response){
        $this->dom->loadHTML($response->getBody());
        $tags = $this->dom->getElementsByTagName("body");
        $this->text = substr($tags->item(0)->textContent, 0, $this->bodyLength);
    }

    public function parseBodyForURLs(Response $response){
        $internalErrors = libxml_use_internal_errors(true);
        $this->dom->loadHTML($response->getBody());
      
        foreach ($this->dom->getElementsByTagName('a') as $node) {
            if($node->hasAttribute('href') && $this->isValidUrl($node->getAttribute('href'))){
                $this->links[] = $node->getAttribute('href');
            }
        }
        libxml_use_internal_errors($internalErrors);

        $links = $this->dom->getElementsByTagName('a');
        $this->numLinks = $links->length;
    }

    public function setUrl(String $url){
        $this->url = $url;
    }
    
    public function setStatusCode(Response $response){
        $this->statusCode = $response->getStatusCode();
    }

    public function getUrl(){
        return $this->url;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getBody(){
        return $this->text;
    }

    public function getLinks(){
        return $this->links;
    }

    public function getNumOfLinks(){
        return $this->numLinks;
    }

    public function getStatusCode(){
        return $this->statusCode;
    }

    public function isValidUrl(String $dirtyUrl){
        $url = filter_var($dirtyUrl, FILTER_SANITIZE_URL);

        if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
            return true;
        }
        return false; 
    }
}