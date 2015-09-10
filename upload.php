<?php
require __DIR__ . '/vendor/autoload.php';

use Rhumsaa\Uuid\Uuid;

if (isset($_POST["snippet"])) {
    $code = $_POST["snippet"];
    if (strlen($code) > 50000 || strlen($code) < 0) {
        header("Location: index.php?err=413");
        die();
    }
    $client = new Predis\Client();
    $filename = randomUniqueKey($client);

    $client->set($filename, $code);
    $client->expire($filename, 60 * 60);    // Expire one hour after setting
    header("Location: view.php?" . $filename);
    die();
} else {
    header("Location: index.php?err=400");
    die();
}

function randomUniqueKey($client)
{
    $uuid = Uuid::uuid4();

    while ($client->exists($uuid)) {
        $uuid = Uuid::uuid4();
    }

    return $uuid;
}