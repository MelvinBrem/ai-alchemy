<?php

declare(strict_types=1);

namespace AIAlchemy;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use GuzzleHttp\Client;

class Game
{
    private Logger $logger;
    private Database $database;

    public function __construct()
    {
        $this->logger = new Logger('gameLogger');
        $this->logger->pushHandler(new StreamHandler(dirname(__DIR__) . '/gameLogger.log', Level::Info));

        $this->set_database();
    }

    private function set_database(): void
    {
        $this->database = new Database($this->logger);
    }

    public function get_item(string $slug): ?Item
    {
        $item_data = $this->database->query('SELECT * FROM items WHERE slug = ?', [$slug]);

        if (empty($item_data)) {
            $this->logger->error('get_item: Item not found: ' . $slug);
            return null;
        }

        return new Item($this->database, $item_data[0]['emoji'], $item_data[0]['name'], $item_data[0]['description'], $item_data[0]['unlocked'] === 1, $item_data[0]['slug']);
    }

    public function get_all_items(): false|array
    {
        $all_item_data = $this->database->query('SELECT * FROM items ORDER BY id ASC');
        if ($all_item_data === false || empty($all_item_data)) {
            return false;
        }

        if (empty($all_item_data)) {
            $this->logger->error('get_all_items: No items found');
            return false;
        }

        $items = [];
        foreach ($all_item_data as $item_data) {
            $items[] = new Item($this->database, $item_data['emoji'], $item_data['name'], $item_data['description'], $item_data['unlocked'] === 1, $item_data['slug']);
        }

        return $items;
    }

    public function get_combination_item(string $item_a, string $item_b): false|Item
    {
        try {
            $result = $this->database->query(
                'SELECT * FROM combinations WHERE (item_a = ? AND item_b = ?) OR (item_a = ? AND item_b = ?)',
                [
                    $item_a,
                    $item_b,
                    $item_b,
                    $item_a
                ]
            );
        } catch (\Exception $e) {
            $this->logger->error('Error fetching combination: ' . $e->getMessage());
            return false;
        }

        if (empty($result)) {
            return $this->generate_new_item($item_a, $item_b);
        }

        $combination = new Combination($this->database, $result[0]['item_a'], $result[0]['item_b'], $result[0]['result']);

        $item_data = $this->database->query('SELECT * FROM items WHERE slug = ?', [$combination->get_result_slug()]);

        if ($item_data === false || empty($item_data)) {
            $this->logger->error('get_combination_item: Item not found: ' . $combination->get_result_slug());
            return false;
        }

        $item = new Item($this->database, $item_data[0]['emoji'], $item_data[0]['name'], $item_data[0]['description'], $item_data[0]['unlocked'] === 1, $item_data[0]['slug']);
        $item->unlock();

        return $item;
    }

    public function generate_new_item(string $item_a, string $item_b): false|Item
    {
        $prompt = vsprintf(file_get_contents(dirname(__DIR__) . '/inc/prompt.txt'), [$item_a, $item_b]);
        try {
            $client = new Client();
            $response = $client->post('https://api.groq.com/openai/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $_ENV['GROQ_API_KEY'],
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'seed' => 42069,
                    'response_format' => [
                        "type" => "json_object"
                    ],
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ],
                    ],
                    'model' => 'llama3-8b-8192',
                ],
            ]);

            $responseBody = $response->getBody()->getContents();
            $result = json_decode($responseBody, true);
            $new_item_data = json_decode($result['choices'][0]['message']['content'], true);

            $this->logger->info('Response: ' . json_encode($new_item_data));

            if (!empty($new_item_data)) {
                $new_item = new Item($this->database, $new_item_data['emoji'], $new_item_data['name'], $new_item_data['description'], true);
                $new_item->save();

                $combination = new Combination($this->database, $item_a, $item_b, $new_item->get_slug());
                $combination->save();
                return $new_item;
            } else {
                $this->logger->error('Invalid response structure: ' . $responseBody);
            }
            return false;
        } catch (\Exception $e) {
            $this->logger->error('Error generating combination: ' . $e->getMessage());
            return false;
        }
    }
}
