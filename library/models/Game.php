<?php

declare(strict_types=1);

namespace AIAlchemy;

class Game
{
    private $database;

    public function __construct()
    {
        $this->set_database();
    }

    private function set_database(): void
    {
        $this->database = new Database();
    }

    public function get_items()
    {
        return $this->database->query('SELECT * FROM items');
    }

    public function get_combinations()
    {
        return $this->database->query('SELECT * FROM combinations');
    }
}
