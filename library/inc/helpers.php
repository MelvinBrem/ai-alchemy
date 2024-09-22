<?php

declare(strict_types=1);

function generate_slug(string $string): string
{
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
};
