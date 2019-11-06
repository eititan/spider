<?php
// DIC configuration
$container = $app->getContainer();
// view renderer
$container['renderer'] = function() use ($container) {
    $settings = $container->get('settings')['renderer'];
    return new \Slim\Views\PhpRenderer($settings['template_path']);
};
// database
$container['db'] = function($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};
// monolog
$container['logger'] = function() use ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};