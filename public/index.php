<?php declare(strict_types=1);

require_once '../vendor/autoload.php';

use RickMorty\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

$loader = new FilesystemLoader('../app/Views');
$twig = new Environment($loader);

$routes = require_once '../routes.php';
$response = Router::response($routes);
echo $twig->render($response->getTemplate() . '.html.twig', $response->getResponse());