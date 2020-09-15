<?php
require_once('vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
define('GOOGLE_RECAPTCHA_PUB', $_ENV['GOOGLE_RECAPTCHA_PUBLIC_KEY'], true);
define('GOOGLE_RECAPTCHA_SEC', $_ENV['GOOGLE_RECAPTCHA_PRIVATE_KEY'], true);
define('DB_HOST', $_ENV['DATABASE_HOST'], true);
define('DB_USER', $_ENV['DATABASE_USER'], true);
define('DB_PASS', $_ENV['DATABASE_PASSWORD'], true);
define('DB_NAME', $_ENV['DATABASE_NAME'], true);
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_errno) {
    echo "Failed to connect to the database.";
    die();
}
