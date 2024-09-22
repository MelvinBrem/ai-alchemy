<?php

declare(strict_types=1);

namespace AIAlchemy;

use Monolog\Logger;

class Item
{
    private Database $database;

    public $name;
    public $unlocked;
    public $description;
    public $slug;

    public function __construct(Database $database, string $name, string $description, bool $unlocked, string $slug = '')
    {
        $this->database = $database;

        $this->slug = !empty($slug) ? $slug : generate_slug($name);
        $this->name = $name;
        $this->unlocked = $unlocked;
        $this->description = $description;
    }

    public function get_slug(): string
    {
        return $this->slug;
    }

    public function unlock(): void
    {
        $this->database->query(
            'UPDATE items SET unlocked = 1 WHERE slug = ?',
            [$this->slug]
        );
    }

    public function save(): void
    {
        $this->database->query(
            'INSERT INTO items (slug, name, unlocked, description) VALUES (?, ?, ?, ?)',
            [
                $this->slug,
                $this->name,
                true,
                $this->description
            ]
        );
    }
}
