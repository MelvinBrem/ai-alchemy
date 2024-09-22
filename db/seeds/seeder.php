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
                'name' => '💩 Dirt',
                'slug' => 'dirt',
                'description' => 'Loose soil found on the ground',
                'unlocked' => true,
            ],
            [
                'name' => '🌬️ Wind',
                'slug' => 'wind',
                'description' => 'Air in natural motion',
                'unlocked' => true,
            ],
            [
                'name' => '🔥 Fire',
                'slug' => 'fire',
                'description' => 'A rapid oxidation process that produces heat and light',
                'unlocked' => true,
            ],
            [
                'name' => '💦 Water',
                'slug' => 'water',
                'description' => 'A clear, colorless liquid essential for life',
                'unlocked' => true,
            ],
            [
                'name' => '🌱 Plant',
                'slug' => 'plant',
                'description' => 'A living organism of the kind exemplified by trees, shrubs, herbs, grasses, ferns, and mosses',
            ],
            // Combinations
            [
                'name' => '💨 Dust',
                'slug' => 'dust',
                'description' => 'Fine particles of matter'
            ],
            [
                'name' => '💩 Mud',
                'slug' => 'mud',
                'description' => 'Wet, soft earth'
            ],
            [
                'name' => '💨 Steam',
                'slug' => 'steam',
                'description' => 'Water vapor'
            ],
            [
                'name' => '🌋 Lava',
                'slug' => 'lava',
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
