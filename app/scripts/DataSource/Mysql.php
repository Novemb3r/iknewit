<?php

declare(strict_types=1);

namespace App\DataSource;

use PDO;

class Mysql
{
    /**
     * @var PDO
     */
    private PDO $connection;


    public function __construct()
    {
        $host = (string)getenv('MYSQL_HOST');
        $db = (string)getenv('MYSQL_DATABASE');
        $port = (string)getenv('MYSQL_PORT');
        $username = (string)getenv('MYSQL_USER');
        $password = (string)getenv('MYSQL_PASSWORD');

        $this->connection = new PDO("mysql:host=$host;port=$port;dbname=$db", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
