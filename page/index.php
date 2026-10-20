<?php
/**
 * 固定ページ (個別のページ: /page/xxx/. 例: /page/about/, /page/studio/)
 * ページは content/page/*.md に置く. URL は page/.htaccess のリライトで振り分ける
 * frontmatter の sections に content/ のディレクトリ名を書くと, その中の Markdown を画像付きの段落として並べる
 */
require_once dirname(__DIR__) . '/inc/templates/posts.php';

render_posts('page', ['layout' => 'page']);
