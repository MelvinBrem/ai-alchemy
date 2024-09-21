<?php

declare(strict_types=1);

namespace AIAlchemy;

class Database
{
    private $host, $name, $user, $pass;
    private $conn;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'] ?? '';
        $this->name = $_ENV['DB_NAME'] ?? '';
        $this->user = $_ENV['DB_USER'] ?? '';
        $this->pass = $_ENV['DB_PASS'] ?? '';

        $this->set_conn();
    }

    private function set_conn(): void
    {
        try {
            $this->conn = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->name, $this->user, $this->pass);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            error_log('Connection failed: ' . $e->getMessage());
        }
    }

    public function query(string $sql): array
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log('Query failed: ' . $e->getMessage());
        }
    }
}
