<?php

include_once dirname(__DIR__) . '/inc/ContentLoader.php';

$dir   = dirname(__DIR__) . '/content/posts/';
$count = (int)($_GET['count'] ?? 10);
$page  = (int)($_GET['page'] ?? 1);

// 最新記事を取得
$loader = new ContentLoader($dir);
$posts  = $loader->load();
$posts  = array_slice($posts, $count * ($page - 1), $count);

// APIのアクセス許可
header("Access-Control-Allow-Origin: *");

// JSON出力
echo json_encode($posts, JSON_UNESCAPED_UNICODE);
return;
