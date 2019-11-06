<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\crawl\Crawler;

// Routes
$app->get('/', function (Request $request, Response $response, array $args) use($app){
    return $this->renderer->render($response, 'index.phtml', $args);
});

//posting to chat from post.phtml
$app->post('/', function (Request $request, Response $response, array $args) use($app){
    $data = $request->getParsedBody();
    $_SESSION['url_searched'] = $data['url'];

    $crawler = new Crawler($data['url']);
    //echo($crawler->getResponseBody());

    return $this->renderer->render($response, 'index.phtml', ['data'=>$data]);
})->setName("post-chat");

//for adding crawl information to user
// $app->post('/ajaxCrawl', function (Request $request, Response $response, array $args) use($app){
//     $data = $this->get('db')->table('eititan_feed')->get();
//     return $this->renderer->render($response, 'ajaxCrawl.php', ['data'=>$data]);
// });



//get from db when we add persistance
//$data = $this->get('db')->table('table_name')->get();


//example log code inside post
//$this->logger->info("User",  ['User' => $data['user']]);