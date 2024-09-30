<?php

declare(strict_types=1);

require dirname(__DIR__) . '/bootstrap.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;

header('Content-Type: application/json; charset=utf-8');

$logger = new Logger('endpointLogger');
$logger->pushHandler(new StreamHandler('./endpointLogger.log', Level::Info));

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);

switch ($action) {
    case 'get_all_items':
        $response = $game->get_all_items();
        if ($response === false) {
            http_response_code(400);
        }
        break;

    case 'merge_items':
        $items_to_merge = json_decode(file_get_contents('php://input'));
        $logger->info('Items to merge: ' . json_encode($items_to_merge));
        $response = $game->get_combination_item($items_to_merge[0], $items_to_merge[1]);
        if ($response === false) {
            http_response_code(400);
        }
        break;

    default:
        break;
}

echo json_encode($response);

return;
