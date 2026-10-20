<?php
/**
 * 版画ゆうびん (一覧: /posts/, 2ページ目以降: /posts/page/2/, 個別記事: /posts/xxx/)
 * 記事は content/posts/*.md に置く. URL は posts/.htaccess のリライトで振り分ける
 */
require_once dirname(__DIR__) . '/inc/templates/posts.php';

render_posts('posts');
