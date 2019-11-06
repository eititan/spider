<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();
//TODO: intialize session crawling
//$_SESSION["crawling"] = false;

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Register routes
require __DIR__ . '/../crawler/Crawler.php';
require __DIR__ . '/../crawler/CrawlerQueue.php';
require __DIR__ . '/../crawler/PageParser.php';


//include models
//require __DIR__ . '/../models/Posts.php';

//initialize database
//$app->getContainer()->get('db');

// Run app
try {
    $app->run();
} catch (\Exception $e) {
    die($e->getCode().": ".$e->getMessage());
}
