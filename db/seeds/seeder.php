<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class seeder extends AbstractSeed
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
                'slug' => 'dirt',
                'name' => 'Dirt',
                'initial' => true,
                'description' => 'Dirty and solid'
            ],
            [
                'slug' => 'wind',
                'name' => 'Wind',
                'initial' => true,
                'description' => 'Invisible and light'
            ],
            [
                'slug' => 'fire',
                'name' => 'Fire',
                'initial' => true,
                'description' => 'Hot and dangerous'
            ],
            [
                'slug' => 'water',
                'name' => 'Water',
                'initial' => true,
                'description' => 'Wet and fluid'
            ],
            // Combinations
            [
                'slug' => 'dust',
                'name' => 'Dust',
                'description' => 'Dry and dirty'
            ],
            [
                'slug' => 'mud',
                'name' => 'Mud',
                'description' => 'Wet and dirty'
            ],
            [
                'slug' => 'steam',
                'name' => 'Steam',
                'description' => 'Hot and wet'
            ],
            [
                'slug' => 'lava',
                'name' => 'Lava',
                'description' => 'Hot and liquid'
            ],
        ];

        $items = $this->table('items');
        $items->insert($itemData)->saveData();

        $combinationData = [
            [
                'item_a' => 'dirt',
                'item_b' => 'wind',
                'result' => 'dust'
            ],
            [
                'item_a' => 'dirt',
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
                'item_b' => 'dirt',
                'result' => 'lava'
            ]
        ];

        $combinations = $this->table('combinations');
        $combinations->insert($combinationData)->saveData();
    }
}
