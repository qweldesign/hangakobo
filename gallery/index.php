<?php
/**
 * 木版画ギャラリー (/gallery/)
 * 作品は config.php の SITE_ARTWORKS (showOnGallery が true の作品) から並べる
 */
require_once dirname(__DIR__) . '/inc/templates/gallery.php';

$title = '木版画ギャラリー';
$lead  = 'おさのなおこの木版画ポートフォリオ。';

$breadcrumb = new ContentNavigation([
  'parents'     => array_map(fn($crumb) => ['label' => $crumb['label'], 'path' => path($crumb['path'])], SITE_BREADCRUMB),
  'subdirLabel' => $title,
  'subdirPath'  => path('gallery/'),
]);

render_header([
  'title'       => $title,
  'description' => $lead,
  'path'        => 'gallery/',
  'preloader'   => true,
]);
?>
    <main id="main" class="main">
      <div class="main__container">
        <header class="main__header">
          <h1 class="main__title"><?= e($title) ?></h1>
          <p class="main__lead"><?= e($lead) ?></p>
        </header>
        <?= $breadcrumb->breadcrumb() ?>
      </div>
<?php render_artwork_slider('showOnGallery'); ?>
    </main>
<?php render_footer(); ?>
