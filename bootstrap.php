<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
use mysql\SeedTables;
use mysql\CreateTables;
use src\App\Database;

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

$db = new Database();
$dbConnection = $db->getConnection();

$dbStatus = getenv('DB_STATUS');
if ($dbStatus == 'none') {
    $tablesCreated = CreateTables::createTables($dbConnection);

    echo 'tables created? - '.$tablesCreated;
    $dataInserted = SeedTables::seedTables($dbConnection);
    echo '<br>Data inserted? - '.$dataInserted;

    if ($tablesCreated && $dataInserted) {
        putenv('DB_STATUS=complete');
    }
}