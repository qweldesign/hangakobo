<?php
/**
 * お知らせ (一覧: /info/, 2ページ目以降: /info/page/2/, 個別記事: /info/xxx/)
 * 記事は content/info/*.md に置く. URL は info/.htaccess のリライトで振り分ける
 */
require_once dirname(__DIR__) . '/inc/templates/posts.php';

render_posts('info');
