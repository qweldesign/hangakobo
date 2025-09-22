<?php
// Hangakobo start!
require_once dirname(__DIR__) . '/inc/Hangakobo.php';
$cms = new Hangakobo();

// APIのアクセス許可
header("Access-Control-Allow-Origin: *");

// JSON出力
echo json_encode($cms->get_posts(), JSON_UNESCAPED_UNICODE);
return;
