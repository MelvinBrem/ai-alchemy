<?php

declare(strict_types=1);

namespace AIAlchemy;

use Monolog\Logger;
use PDO;

class Database
{
    private Logger $logger;
    private string $host, $name, $user, $pass;
    private PDO $conn;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;

        $this->host = $_ENV['DB_HOST'] ?? '';
        $this->name = $_ENV['DB_NAME'] ?? '';
        $this->user = $_ENV['DB_USER'] ?? '';
        $this->pass = $_ENV['DB_PASS'] ?? '';

        $this->set_conn();
    }

    private function set_conn(): void
    {
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->name, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            $this->logger->error('Connection failed: ' . $e->getMessage());
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function query(string $sql, array $options = []): false|array
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($options);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $rows = $stmt->fetchAll();
            return $rows;
        } catch (\PDOException $e) {
            $this->logger->error('Query "' . $sql . '" failed: ' . $e->getMessage());
            return false;
        }
    }
}
