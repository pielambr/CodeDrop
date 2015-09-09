<?php
require __DIR__ . '/vendor/autoload.php';

if (isset($_POST["snippet"])) {
    $code = $_POST["snippet"];
    if (strlen($code) > 50000 || strlen($code) < 0) {
        header("Location: index.php?err=413");
        die();
    }
    $filename = createFilename();

    $client = new Predis\Client();

    $client->set($filename, $code);
    $client->expire($filename, 60 * 60);    // Expire one hour after setting
    header("Location: view.php?" . $filename);
    die();
} else {
    header("Location: index.php?err=400");
    die();
}

function createFilename()
{
    // http://stackoverflow.com/questions/19017694/1line-php-random-string-generator
    $name = substr("abcdefghijklmnopqrstuvwxyz", mt_rand(0, 25), 1) . substr(md5(time()), 1);
    // Check if file already exists
    if (!file_exists("snippets/" . $name)) {
        return $name;
    } else {
        return createFilename();
    }
}