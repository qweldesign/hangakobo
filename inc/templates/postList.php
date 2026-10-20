<?php
/**
 * postList.php
 * © 2026 QWEL.DESIGN (https://qwel.design)
 * Released under the MIT License.
 * See LICENSE file for details.
 *
 * 記事一覧 (.postList.is-list)
 * アイキャッチがない記事は, SITE_THUMBNAIL_IMAGE (config.php) を代わりに表示する
 */

require_once dirname(__DIR__) . '/partials/site.php';

/**
 * $posts: ContentEngine::get_posts() の戻り値
 * $type: 投稿タイプ (記事の URL に使う)
 * $options:
 *   show_date: 日付を表示するか (規定で投稿タイプの show_date)
 *   switched: 画像と文章の左右を入れ替える (.is-switched)
 *   heading: 記事タイトルの見出しのタグ (規定で h3)
 */
function render_post_list(array $posts, string $type, array $options = []): void {
  $showDate = $options['show_date'] ?? post_type($type)['show_date'];
  $tag = $options['heading'] ?? 'h3';
?>
          <ul class="postList is-list<?= !empty($options['switched']) ? ' is-switched' : '' ?>">
<?php foreach ($posts as $post) { ?>
<?php $url = post_url($type, $post); ?>
            <li class="postList__item postItem">
              <figure class="postItem__image">
                <a href="<?= e($url) ?>" tabindex="-1">
                  <img src="<?= e(image_url($post['img'] ?? null)) ?>" alt="" loading="lazy">
                </a>
              </figure>
              <div class="postItem__content">
<?php if ($showDate && !empty($post['date'])) { ?>
                <div class="postItem__info">
                  <?= date_tag($post['date'], 'postItem__date') ?>
                </div>
<?php } ?>
                <<?= $tag ?> class="postItem__heading">
                  <a href="<?= e($url) ?>"><?= e($post['title'] ?? '') ?></a>
                </<?= $tag ?>>
                <p class="postItem__excerpt">
                  <?= e($post['summary'] ?? '') ?>
                  <a class="postItem__more" href="<?= e($url) ?>" aria-hidden="true" tabindex="-1">もっと詳しく &gt;</a>
                </p>
              </div>
            </li>
<?php } ?>
          </ul>
<?php
}

// 記事の小さな一覧 (個別記事の横に並べる「最新記事」など. .postIndex)
function render_post_index(array $posts, string $type): void {
?>
            <ul class="postIndex">
<?php foreach ($posts as $post) { ?>
              <li class="postIndex__item">
                <a href="<?= e(post_url($type, $post)) ?>">
                  <img class="postIndex__image" src="<?= e(image_url($post['img'] ?? null)) ?>" alt="" loading="lazy">
<?php if (post_type($type)['show_date'] && !empty($post['date'])) { ?>
                  <?= date_tag($post['date'], 'postIndex__date') ?>
<?php } ?>
                  <span class="postIndex__title"><?= e($post['title'] ?? '') ?></span>
                </a>
              </li>
<?php } ?>
            </ul>
<?php
}
