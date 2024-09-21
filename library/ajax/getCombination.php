<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

echo json_encode($game->get_combination());
return;
