<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Router;
use App\Http\Request;

// Setup PDO according to GPT, will look more into MySQL in the future
// Must remember that these credentials are set up in my docker compose file
// Credentials should obviously be stored securely as SECRETs or in an ENV file, I
// previously used SECRETs in GCF but we don't have all day here. 

$host = 'mysql';
$dbname = 'mydb';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$username = 'user';
$password = 'password';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$pdo = new PDO($dsn, $username, $password, $options);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$router = new Router($pdo);
$request = new Request();

$response = $router->dispatch($request);

echo $response;