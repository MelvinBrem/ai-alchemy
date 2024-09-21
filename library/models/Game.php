<?php

declare(strict_types=1);

namespace AIAlchemy;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use GuzzleHttp\Client;

class Game
{
    private ?Logger $logger;
    private Database $database;

    public function __construct()
    {
        $this->logger = new Logger('gameLogger');
        $this->logger->pushHandler(new StreamHandler(dirname(__DIR__, 2) . '/gameLogger.log', Level::Info));

        $this->set_database();
    }

    private function set_database(): void
    {
        $this->database = new Database($this->logger);
    }

    public function get_items()
    {
        return $this->database->query('SELECT * FROM items');
    }

    public function get_combinations()
    {
        return $this->database->query('SELECT * FROM combinations');
    }

    public function get_combination(array $items)
    {
        if (!is_array($items) || empty($items) || count($items) < 2) {
            return false;
        }
        $item_a = $items[0];
        $item_b = $items[1];

        $query = 'SELECT * FROM combinations WHERE (item_a = ? AND item_b = ?) OR (item_a = ? AND item_b = ?)';
        $result = $this->database->query($query, [$item_a, $item_b, $item_b, $item_a]);
        return $result;
    }

    public function generate_combination(array $items)
    {
        $prompt = vsprintf(file_get_contents(dirname(__DIR__, 2) . '/inc/prompt.txt'), $items) ?? 'Something went wrong';
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

            $this->logger->info($prompt);

            $result = json_decode($response->getBody()->getContents(), true);
            $result = $result['choices'][0]['message']['content'];
            return $result;
        } catch (\Exception $e) {
            $this->logger->error('Error generating combination: ' . $e->getMessage());
            return false;
        }
    }
}
