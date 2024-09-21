<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

$entityBody = file_get_contents('php://input');
$itemsToMerge = json_decode($entityBody);

$combination = $game->get_combination($itemsToMerge);
if (!empty($combination)) {
    echo json_encode($game->get_combination($itemsToMerge));
    return;
}

$combination = $game->generate_combination($itemsToMerge);
echo json_encode($combination);
return;
