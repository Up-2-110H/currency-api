<?php

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . "/..");
$dotenv->load();

$dotenv->required([
    'DB_DSN',
    'DB_USER',
    'DB_PASSWORD',
    'TEST_YII_ENV',
    'TEST_DB_DSN',
    'PARSE_URL'
]);

$dotenv->required(['YII_ENV'])->allowedValues(['prod', 'dev', 'test']);
$dotenv->required(['YII_DEBUG'])->allowedValues(['0', '1']);
