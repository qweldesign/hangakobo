<?php
// Hangakobo start!
require_once dirname(__DIR__) . '/inc/Hangakobo.php';
$hangakobo = new Hangakobo();

// APIのアクセス許可
header("Access-Control-Allow-Origin: *");

// JSON出力
echo json_encode($hangakobo->info, JSON_UNESCAPED_UNICODE);
return;
