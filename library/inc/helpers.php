<?php

declare(strict_types=1);

function generate_slug(string $string): string
{
    // Remove emojis
    $string = preg_replace('/[\x{1F600}-\x{1F64F}]/u', '', $string); // Emoticons
    $string = preg_replace('/[\x{1F300}-\x{1F5FF}]/u', '', $string); // Misc Symbols and Pictographs
    $string = preg_replace('/[\x{1F680}-\x{1F6FF}]/u', '', $string); // Transport and Map
    $string = preg_replace('/[\x{2600}-\x{26FF}]/u', '', $string); // Misc symbols
    $string = preg_replace('/[\x{2700}-\x{27BF}]/u', '', $string); // Dingbats

    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
};
