<?php

use App\Middlewares\Format;
use App\Routing\NotesApi;
use DI\Bridge\Slim\Bridge;

define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH . '/vendor/autoload.php';

$app = Bridge::create();
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

NotesApi::register($app);

$app->add(Format::class);

$app->run();
