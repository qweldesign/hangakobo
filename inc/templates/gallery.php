<?php
/**
 * gallery.php
 *
 * 木版画の作品のスライダー (トップページの木版画ギャラリーと /gallery/)
 * 作品の一覧は config.php の SITE_ARTWORKS (JSON. 新しい作品を後ろに追加していく)
 * 画像は SITE_ARTWORKS_DIR の {name}s.png
 */

require_once dirname(__DIR__) . '/partials/site.php';

// 作品の一覧 (新しい順. 読めない場合は空の配列)
function load_artworks(): array {
  $file = dirname(__DIR__, 2) . '/' . SITE_ARTWORKS;
  $json = is_readable($file) ? json_decode(file_get_contents($file), true) : null;
  return is_array($json) ? array_reverse($json) : [];
}

// 作品の画像の URL
function artwork_url(array $artwork): string {
  return path(SITE_ARTWORKS_DIR . '/' . ($artwork['name'] ?? '') . 's.png');
}

/**
 * $flag: 表示する作品の項目 (showOnFront: トップページ, showOnGallery: ギャラリー)
 */
function render_artwork_slider(string $flag): void {
?>
      <div class="slider" data-gallery="slider" data-flickable data-aspect-ratio="0.5" data-gap="144">
        <figure class="slider__inner" data-gallery-main>
<?php foreach (load_artworks() as $artwork) { ?>
<?php if (!empty($artwork[$flag])) { ?>
          <figure class="slider__item" data-gallery-item>
            <img class="slider__image" src="<?= e(artwork_url($artwork)) ?>" alt="<?= e($artwork['title'] ?? '') ?>">
            <figcaption class="slider__caption"><?= e($artwork['title'] ?? '') ?></figcaption>
          </figure>
<?php } ?>
<?php } ?>
        </figure>
      </div>
<?php
}
