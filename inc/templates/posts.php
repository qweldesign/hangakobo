<?php
/**
 * posts.php
 * © 2026 QWEL.DESIGN (https://qwel.design)
 * Released under the MIT License.
 * See LICENSE file for details.
 *
 * 投稿タイプの一覧と個別記事を出力する共通テンプレート
 * 一覧: config.php の path, 個別記事: ?slug=xxx (SITE_PRETTY_URLS なら xxx/)
 *
 * 使い方 (一覧を置くディレクトリの index.php):
 *   require_once __DIR__ . '/inc/templates/posts.php';
 *   render_posts('posts');
 */

require_once __DIR__ . '/postList.php';
require_once __DIR__ . '/mediaText.php';

/**
 * $type: 投稿タイプ (config.php の SITE_POST_TYPES のキー)
 * $options:
 *   layout: 'post' (規定. 見出しは投稿タイプの名前, 記事の横に最新記事)
 *           'page' (固定ページ. 見出しはページのタイトル, frontmatter の sections の段落を並べる)
 *   latest: 個別記事の横に並べる最新記事の件数 (規定で 4. 並べる投稿タイプは config.php の aside)
 *   preloader: 読み込み中の画面を出すか (規定で layout が page のとき)
 */
function render_posts(string $type, array $options = []): void {
  $config = post_type($type);
  $label  = $config['label'];
  $isPage = ($options['layout'] ?? 'post') === 'page';
  $latest = $options['latest'] ?? 4;
  $cms = content_engine($type);

  // 記事が見つからない場合と, 一覧のページ番号が範囲外の場合は 404
  $notFound = $cms->is_not_found();
  if ($notFound) {
    http_response_code(404);
  }

  if ($cms->is_found()) {
    $page = [
      'title'       => $isPage ? $cms->get_title() : $cms->get_title() . ' | ' . $config['title'],
      'description' => $cms->get_meta('summary'),
      'path'        => post_path($type, ['slug' => $cms->get_meta('slug')]),
      'image'       => $cms->get_meta('img'),
    ];
  } else {
    $pageNumber = $cms->get_page();
    $page = [
      'title'       => $notFound ? 'ページが見つかりません' : ($pageNumber > 1 ? "{$config['title']} ({$pageNumber}ページ目)" : $config['title']),
      'description' => $config['description'],
      'path'        => page_path($type, $pageNumber),
      'noindex'     => $notFound,
    ];
  }
  $page['preloader'] = $options['preloader'] ?? $isPage;

  // 見出し (固定ページはページのタイトル, それ以外は投稿タイプの名前)
  if ($notFound) {
    $heading = 'ページが見つかりません';
    $lead = '';
  } elseif ($isPage && $cms->is_found()) {
    $heading = $cms->get_title();
    $lead = $cms->get_meta('lead');
  } else {
    $heading = $label;
    $lead = $config['lead'];
  }

  render_header($page);
?>
    <main id="main" class="main">
      <div class="main__container">
        <header class="main__header">
          <h1 class="main__title"><?= e($heading) ?></h1>
<?php if ($lead) { ?>
          <p class="main__lead"><?= e($lead) ?></p>
<?php } ?>
        </header>
        <?= $cms->get_breadcrumb() ?>
        <div class="main__content">
<?php if ($notFound) { ?>
          <div class="main__article">
            <p>お探しのページは、削除されたか、URLが変更された可能性があります。</p>
            <p><a href="<?= e($isPage ? path() : type_url($type)) ?>"><?= e($isPage ? 'トップ' : $label . 'の一覧') ?>へ</a></p>
          </div>
<?php } elseif ($cms->is_found() && $isPage) { ?>
<?php if (trim($cms->get_meta('content')) !== '') { ?>
          <article class="main__article">
<?= $cms->get_content() ?>
          </article>
<?php } ?>
<?php if ($cms->get_meta('sections')) { ?>
          <section class="main__section">
<?php render_media_text(load_sections($cms->get_meta('sections'))); ?>
          </section>
<?php } ?>
<?php } elseif ($cms->is_found()) { ?>
          <article class="main__article">
<?php if ($config['show_date'] && $cms->get_meta('date')) { ?>
            <div class="main__date"><?= date_tag($cms->get_meta('date')) ?></div>
<?php } ?>
<?= $cms->get_content() ?>
          </article>
<?php if ($latest > 0 && $config['aside']) { ?>
          <aside class="main__aside">
<?php foreach ($config['aside'] as $asideType) { ?>
            <h2 class="main__heading">最新の<?= e(post_type($asideType)['label']) ?></h2>
<?php render_post_index(content_engine($asideType, ['slug' => null, 'page' => 1])->get_posts(1, $latest), $asideType); ?>
<?php } ?>
          </aside>
<?php } ?>
<?php } else { ?>
<?php render_post_list($cms->get_posts(), $type); ?>
          <?= $cms->pagination() ?>
<?php } ?>
        </div>
      </div>
    </main>
<?php
  render_footer();
}
