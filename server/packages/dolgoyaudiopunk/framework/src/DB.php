<?php

namespace DolgoyAudiopunk\Framework;

use PDO;

class DB extends Singleton
{
    /**
     * @var PDO
     */
    protected PDO $pdo;


    /**
     *
     */
    protected function __construct()
    {
        parent::__construct();

        $db = require ROOT . '/config/database.php';

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $this->pdo = new PDO($db['dns'], $db['username'], $db['password'], $options);
    }

    /**
     * @param string $sql
     * @param array  $param
     * @return array
     */
    public function query(string $sql, array $param = []): array
    {
        $PDOStatement = $this->pdo->prepare($sql);
        $result = $PDOStatement->execute($param);
        if ($result !== false) {
            return $PDOStatement->fetchAll();
        }

        echo 'ПО данному запросу ничего не нашли';
        return [];

    }
}
