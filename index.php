<?php

use RickMorty\ApiClient;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new ApiClient();
$characters = $client->createCollection();
var_dump($characters);
