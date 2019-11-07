<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\crawler\Crawler;

// Routes
$app->get('/', function (Request $request, Response $response, array $args) use($app){
    return $this->renderer->render($response, 'index.phtml', $args);
});

//posting to chat from index.phtml
$app->post('/', function (Request $request, Response $response, array $args) use($app){
    $body = $request->getParsedBody();
    $crawler = new Crawler($body['url']);
    $data = $crawler->getCrawledPages();

    return $this->renderer->render($response, 'index.phtml', ['data'=>$data]);
});

//for adding crawl information to user
// $app->post('/ajaxCrawl', function (Request $request, Response $response, array $args) use($app){
//     return $this->renderer->render($response, 'ajaxCrawl.php', ['data'=>$data]);
// });


//get from db when we add persistance
//$data = $this->get('db')->table('table_name')->get();


//example log code inside post
//$this->logger->info("User",  ['User' => $data['user']]);