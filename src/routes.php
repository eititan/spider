<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\crawler\Crawler;

// Routes
$app->get('/', function (Request $request, Response $response, array $args) use($app){
    return $this->renderer->render($response, 'index.phtml', $args);
});

//posting to with crawled info index.phtml
$app->post('/', function (Request $request, Response $response, array $args) use($app){
    $body = $request->getParsedBody();
    $crawler = new Crawler($body['url']);
    $pageInfo = $crawler->getCrawledPages();
    
    $this->get('db')->table('spider')->delete();
    foreach($pageInfo as $p){

        $array = array('url' => $p->getUrl(), 'title' => $p->getTitle(), 'num_of_links' => $p->getNumOfLinks(), 
            'status_code' => $p->getStatusCode(), 'body' => $p->getBody(), 'crawled_on' => \Carbon\Carbon::now());
        
        $this->logger->info("page crawled",  ['page' => $array]);

        $page = new CrawlerModel;
        $page->fill($array);
        $page->save();
    }

    $data = $this->get('db')->table('spider')->get();    ;
    return $this->renderer->render($response, 'index.phtml', ['data'=>$data]);
});