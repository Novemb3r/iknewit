<?php

declare(strict_types=1);

namespace App\DataSource;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Doctrine
{

    /**
     * @var EntityManager
     */
    public EntityManager $entityManager;

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function __construct()
    {
        $configuration = Setup::createAnnotationMetadataConfiguration(
            [__DIR__ . './Entities'],
            true
        );

        $host = getenv('MYSQL_HOST');
        $db = getenv('MYSQL_DATABASE');
        $port = getenv('MYSQL_PORT');
        $username = getenv('MYSQL_USER');
        $password = getenv('MYSQL_PASSWORD');

        $connection_parameters = [
            'dbname' => $db,
            'user' => $username,
            'password' => $password,
            'host' => $host,
            'port' => $port,
            'driver' => 'pdo_mysql'
        ];

        $this->entityManager = EntityManager::create($connection_parameters, $configuration);
    }
}
