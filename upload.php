<?php
/**
 * Created by PhpStorm.
 * User: Pieterjan Lambrecht
 * Date: 22/05/15
 * Time: 20:47
 */
if(isset($_POST["snippet"])){
    $code = $_POST["snippet"];
    if(strlen($code) > 50000 || strlen($code) < 0){
        header("Location: index.php?err=413");
        die();
    }
    $filename = createFilename();
    $snippet_file = fopen("snippets/" . $filename . ".txt", "w");
    fwrite($snippet_file, $code);
    fclose($snippet_file);
    header("Location: view.php?" . $filename);
    die();
} else {
    header("Location: index.php?err=400");
    die();
}

function createFilename() {
    // http://stackoverflow.com/questions/19017694/1line-php-random-string-generator
    $name = substr( "abcdefghijklmnopqrstuvwxyz" ,mt_rand( 0 ,25 ) ,1 ) .substr( md5( time( ) ) ,1 );
    // Check if file already exists
    if(!file_exists("snippets/" . $name)){
        return $name;
    } else {
        return createFilename();
    }
}