<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class ItemSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $itemData = [
            [
                'slug' => 'earth',
                'name' => 'Earth'
            ],
            [
                'slug' => 'wind',
                'name' => 'Wind'
            ],
            [
                'slug' => 'fire',
                'name' => 'Fire'
            ],
            [
                'slug' => 'water',
                'name' => 'Water'
            ],
            // Combinations
            [
                'slug' => 'dust',
                'name' => 'Dust'
            ],
            [
                'slug' => 'mud',
                'name' => 'Mud'
            ],
            [
                'slug' => 'steam',
                'name' => 'Steam'
            ],
            [
                'slug' => 'lava',
                'name' => 'Lava'
            ],
        ];

        $items = $this->table('items');
        $items->insert($itemData)->saveData();

        $combinationData = [
            [
                'item_a' => 'earth',
                'item_b' => 'wind',
                'result' => 'dust'
            ],
            [
                'item_a' => 'earth',
                'item_b' => 'water',
                'result' => 'mud'
            ],
            [
                'item_a' => 'fire',
                'item_b' => 'water',
                'result' => 'steam'
            ],
            [
                'item_a' => 'fire',
                'item_b' => 'earth',
                'result' => 'lava'
            ]
        ];

        $combinations = $this->table('combinations');
        $combinations->insert($combinationData)->saveData();
    }
}
