<?php
/**
 * mediaText.php
 *
 * 画像と文章を横に並べた段落 (.mediaText) の一覧
 * 固定ページの frontmatter の sections (例: sections: "about") で,
 * content/about/*.md を日付の新しい順に並べる
 *
 * 段落の Markdown の frontmatter:
 *   title: 段落の見出し
 *   img: 画像 (サイトのルートからのパス)
 *   class: 画像に付ける class (任意)
 *   date: 並び順 (新しい順)
 */

require_once dirname(__DIR__) . '/partials/site.php';

// content/ の下のディレクトリから段落を読み込む (英数字・ハイフン・アンダースコアのディレクトリ名だけ受け付ける)
function load_sections(string $name): array {
  if (!preg_match('/^[A-Za-z0-9_-]+$/', $name)) return [];
  return (new ContentLoader(dirname(__DIR__, 2) . '/content/' . $name))->load();
}

function render_media_text(array $items): void {
  $parsedown = new Parsedown();
?>
<?php foreach ($items as $item) { ?>
            <section class="mediaText">
<?php if (!empty($item['img'])) { ?>
              <figure class="mediaText__media">
                <img loading="lazy"<?= !empty($item['class']) ? ' class="' . e($item['class']) . '"' : '' ?> src="<?= e(path($item['img'])) ?>" alt="">
              </figure>
<?php } ?>
              <div class="mediaText__content">
<?php if (!empty($item['title'])) { ?>
                <h2 class="mediaText__title"><?= e($item['title']) ?></h2>
<?php } ?>
<?= ContentEngine::resolve_paths($parsedown->text($item['content'] ?? ''), path()) ?>
              </div>
            </section>
<?php } ?>
<?php
}
