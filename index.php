<?php

ini_set( 'display_errors', 1 );
error_reporting(E_ALL);

define('NOVELS_DIR', __DIR__ . '/novels');

$novel_id = isset($_GET["novel"]) ? (int)$_GET["novel"] : null;
$json = [];

if($novel_id === null) {
    $novel = file(NOVELS_DIR . "/novels_list.txt");
    $json = array_merge($json, $novel);
} else {
    $novel = file(NOVELS_DIR . "/novels_list.txt");
    $line = explode("|", $novel[$novel_id]);
    $dir = str_replace(["\n", "\r"], "", $line[1]);
    $episodes = file(NOVELS_DIR . "/" . $dir . "/list.txt");
    $json = array_merge($json, $episodes);
}


echo json_encode($json, JSON_UNESCAPED_UNICODE);