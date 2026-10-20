<?php
/**
 * site.php
 * © 2026 QWEL.DESIGN (https://qwel.design)
 * Released under the MIT License.
 * See LICENSE file for details.
 *
 * 全ページ共通のヘッダー・フッターを出力する
 * 中身 (サイト名, ナビ, SNS など) は config.php の設定から作る
 */

require_once dirname(__DIR__, 2) . '/config.php';
require_once dirname(__DIR__) . '/helpers.php';

/**
 * <head> ~ ヘッダーまで出力
 * $page:
 *   title: ページのタイトル (<title> は「title | サイト名」. 省略するとサイト名だけ)
 *   full_title: <title> をそのまま指定する (トップページなど)
 *   description: description (規定で SITE_DESCRIPTION)
 *   path: このページのサイトのルートからのパス (canonical, og:url に使う)
 *   image: OGP 画像 (規定で SITE_OGP_IMAGE)
 *   type: og:type (規定で article)
 *   noindex: 検索結果に出さない (404 など)
 *   home: トップページか (ロゴを h1 にし, ナビをページ内の位置へのリンクにする)
 *   preloader: 読み込み中の画面を出すか (js/preloader.js)
 */
function render_header(array $page = []): void {
  $title = $page['full_title'] ?? (!empty($page['title']) ? $page['title'] . ' | ' . SITE_NAME : SITE_NAME);
  $description = ($page['description'] ?? '') ?: SITE_DESCRIPTION;
  $url = absolute_url($page['path'] ?? '');
  $image = absolute_url(($page['image'] ?? '') ?: SITE_OGP_IMAGE);
  $home = !empty($page['home']);
  $brandTag = $home ? 'h1' : 'div';
  // body の属性 (読み込み中の画面, 画像の保護)
  $bodyAttrs = '';
  if (!empty($page['preloader'])) {
    $bodyAttrs .= ' class="preloader" data-background-color="' . e(SITE_PRELOADER_COLOR) . '"';
  }
  if (SITE_PROTECT_IMAGES) {
    $bodyAttrs .= ' data-protect-images';
  }
  ?>
<!DOCTYPE html>
<html lang="<?= e(SITE_LANG) ?>">
  <head prefix="og: https://ogp.me/ns#">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--
      Built with QWEL Markdown Engine (Simple CMS)
      A lightweight, file-based CMS that renders Markdown as HTML.
      Created by QWEL.DESIGN - https://qwel.design
      Source: https://github.com/qweldesign/qwel-tools-md-engine (MIT License)
    -->
    <title><?= e($title) ?></title>
    <meta name="description" content="<?= e($description) ?>">
<?php if (!empty($page['noindex'])) { ?>
    <meta name="robots" content="noindex">
<?php } else { ?>
    <link rel="canonical" href="<?= e($url) ?>">
<?php } ?>
    <meta property="og:type" content="<?= e($page['type'] ?? 'article') ?>">
    <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
    <meta property="og:title" content="<?= e($title) ?>">
    <meta property="og:description" content="<?= e($description) ?>">
    <meta property="og:url" content="<?= e($url) ?>">
    <meta property="og:image" content="<?= e($image) ?>">
    <meta name="twitter:card" content="summary_large_image">
<?php if (SITE_FONTS_URL) { ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="<?= e(SITE_FONTS_URL) ?>">
<?php } ?>
    <link rel="stylesheet" href="<?= path('style-1.0.css') ?>">
    <link rel="icon" href="<?= path('favicon.ico') ?>">
<?php if (SITE_GA_ID) { ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e(SITE_GA_ID) ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '<?= e(SITE_GA_ID) ?>');
    </script>
<?php } ?>
  </head>
  <body<?= $bodyAttrs ?>>
    <header id="header" class="header" data-active-header>
      <div class="header__inner">
        <div id="gNav" class="gNav">
          <<?= $brandTag ?> class="gNav__siteBrand" data-site-brand>
            <a href="<?= e(SITE_LOGO_LINK ?: path()) ?>">
<?php if (SITE_LOGO) { ?>
              <img src="<?= path(SITE_LOGO) ?>" alt="<?= e(SITE_LOGO_ALT ?: SITE_NAME) ?>">
<?php } else { ?>
              <?= e(SITE_NAME) ?>
<?php } ?>
            </a>
          </<?= $brandTag ?>>
<?php if (SITE_NAV) { ?>
          <ul class="gNav__primaryMenu" data-primary-menu>
<?php foreach (SITE_NAV as $nav) { ?>
            <li class="gNav__menuItem"><a href="<?= e($home && !empty($nav['anchor']) ? '#' . $nav['anchor'] : path($nav['path'])) ?>"><?= e($nav['label']) ?></a></li>
<?php } ?>
          </ul>
<?php } ?>
<?php if (SITE_SNS) { ?>
          <ul class="gNav__socialMenu" data-social-menu>
<?php foreach (SITE_SNS as $sns) { ?>
<?php $external = (bool)preg_match('#^https?://#', $sns['url']); ?>
            <li class="gNav__menuItem is-social">
              <a href="<?= e(path($sns['url'])) ?>" aria-label="<?= e($sns['label']) ?>"<?= $external ? ' target="_blank" rel="noopener"' : '' ?>>
                <svg class="icon is-<?= e(preg_replace('/^si-/', '', $sns['icon'] ?? '')) ?> is-md" width="36" height="36" aria-hidden="true">
                  <use href="<?= path('icons.svg') ?>#<?= e($sns['icon'] ?? '') ?>"></use>
                </svg>
              </a>
            </li>
<?php } ?>
          </ul>
<?php } ?>
        </div>
      </div>
    </header>
<?php
}

// フッター ~ </html> まで出力
function render_footer(): void {
  ?>
    <div class="cover"></div>
    <footer id="footer" class="footer">
      <div class="footer__copyright">&copy; <?= e(copyright_years()) ?> <?= e(SITE_OWNER) ?> All rights reserved.<?php if (SITE_COPYRIGHT_NOTE) { ?><br><?= SITE_COPYRIGHT_NOTE ?><?php } ?></div>
    </footer>
    <script src="<?= path('init.js') ?>" type="module"></script>
  </body>
</html>
<?php
}
