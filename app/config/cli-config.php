<?php

define('ROOT_PATH', dirname(__DIR__));

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$entityManager = (new \App\DataSource\Doctrine())->entityManager;

return ConsoleRunner::createHelperSet($entityManager);
