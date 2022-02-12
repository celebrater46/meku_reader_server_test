<?php

ini_set( 'display_errors', 1 );
error_reporting(E_ALL);

define('NOVELS_DIR', __DIR__ . '/novels');

$novel_id = isset($_GET["novel"]) ? (int)$_GET["novel"] : null;
$chap_id = isset($_GET["chap"]) ? (int)$_GET["chap"] : null;
$ep_id = isset($_GET["ep"]) ? (int)$_GET["ep"] : null;

$json = [];

if($novel_id === null) {
    $novel = file(NOVELS_DIR . "/novels_list.txt");
    $json = array_merge($json, $novel);
} else {
    $novel = file(NOVELS_DIR . "/novels_list.txt");
    $line = explode("|", $novel[$novel_id]);
    $dir = NOVELS_DIR . "/" . str_replace(["\n", "\r"], "", $line[1]);
    $episodes = file($dir . "/list.txt");
    if($ep_id === null){
        $json = array_merge($json, $episodes);
    } else {
        $ep_line = explode("|", $episodes[$ep_id]);
        $episode = file($dir . "/txts/" . $ep_line[1] . ".txt");
        $json = array_merge($json, $episode);
    }
}

echo json_encode($json, JSON_UNESCAPED_UNICODE);