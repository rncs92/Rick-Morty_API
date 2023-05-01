<?php

use RickMorty\ApiClient;

require_once 'vendor/autoload.php';

$client = new ApiClient();
$characters = $client->createCollection();
var_dump($characters);
