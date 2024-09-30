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
        $item_data = [
            [
                'slug' => 'dirt',
                'emoji' => '💩',
                'name' => 'Dirt',
                'description' => 'Loose soil found on the ground',
                'unlocked' => true,
            ],
            [
                'slug' => 'wind',
                'emoji' => '🌬️',
                'name' => 'Wind',
                'description' => 'Air in natural motion',
                'unlocked' => true,
            ],
            [
                'slug' => 'fire',
                'emoji' => '🔥',
                'name' => 'Fire',
                'description' => 'A rapid oxidation process that produces heat and light',
                'unlocked' => true,
            ],
            [
                'slug' => 'water',
                'emoji' => '💦',
                'name' => 'Water',
                'description' => 'A clear, colorless liquid essential for life',
                'unlocked' => true,
            ],
            [
                'slug' => 'plant',
                'emoji' => '🌱',
                'name' => 'Plant',
                'description' => 'A living organism of the kind exemplified by trees, shrubs, herbs, grasses, ferns, and mosses',
                'unlocked' => true,
            ],
            // Combinations
            [
                'slug' => 'dust',
                'emoji' => '💨',
                'name' => 'Dust',
                'description' => 'Fine particles of matter'
            ],
            [
                'slug' => 'mud',
                'emoji' => '💩',
                'name' => 'Mud',
                'description' => 'Wet, soft earth'
            ],
            [
                'slug' => 'steam',
                'emoji' => '💨',
                'name' => 'Steam',
                'description' => 'Water vapor'
            ],
            [
                'slug' => 'lava',
                'emoji' => '🌋',
                'name' => 'Lava',
                'description' => 'Molten ground'
            ],
        ];

        $items = $this->table('items');
        $items->insert($item_data)->saveData();

        $combination_data = [
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
                'item_a' => 'water',
                'item_b' => 'fire',
                'result' => 'steam'
            ],
            [
                'item_a' => 'fire',
                'item_b' => 'dirt',
                'result' => 'lava'
            ]
        ];

        $combinations = $this->table('combinations');
        $combinations->insert($combination_data)->saveData();
    }
}
