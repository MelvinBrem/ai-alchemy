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

$logger->info('Endpoint accessed, ' . $action);

switch ($action) {
    case 'get_all_items':
        $response = $game->get_all_items();
        break;

    case 'merge_items':
        $itemsToMerge = json_decode(file_get_contents('php://input'));
        $logger->info('Items to merge: ' . json_encode($itemsToMerge));
        $response = $game->get_combination_item($itemsToMerge);
        break;

    default:
        break;
}

echo json_encode($response);

return;
