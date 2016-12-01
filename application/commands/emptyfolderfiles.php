<?php
$sitePath = realpath(__DIR__);
$pathtofiles = $sitePath.'/../../files/';

foreach (glob($pathtofiles."*.pdf") as $filename) {
    echo "$filename размер " . filesize($filename) . "\n";
    unlink($filename);
}