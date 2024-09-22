<?php

declare(strict_types=1);

namespace AIAlchemy;

use Monolog\Logger;

class Combination
{
    private Database $database;

    public $item_a_slug;
    public $item_b_slug;
    public $item_result_slug;

    public function __construct(Database $database, string $item_a_slug, string $item_b_slug, string $item_result_slug)
    {
        $this->database = $database;

        $this->item_a_slug = $item_a_slug;
        $this->item_b_slug = $item_b_slug;
        $this->item_result_slug = $item_result_slug;
    }

    public function get_result_slug(): string
    {
        return $this->item_result_slug;
    }

    public function save(): void
    {
        $this->database->query(
            'INSERT INTO combinations (item_a, item_b, result) VALUES (?, ?, ?)',
            [
                $this->item_a_slug,
                $this->item_b_slug,
                $this->item_result_slug
            ]
        );
    }
}
