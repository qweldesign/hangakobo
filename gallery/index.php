<?php
// Hangakobo start!
require_once dirname(__DIR__) . '/inc/Hangakobo.php';
$cms = new Hangakobo();
?>

<!DOCTYPE html>
<html>
  <head prefix="og: https://ogp.me/ns#">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>木版画ギャラリー | 版画ゆうびん舎</title>
    <meta name="description" content="心に残った風景、身近な動植物、変哲の無い日用品、天使や架空の動物たちなど、おさのなおこの木版画ポートフォリオ。">
    <meta property="og:site_name" content="版画ゆうびん舎">
    <meta property="og:type" content="article">
    <meta property="og:image" content="https://hangakobo.com/content/ogp/2025-hangakobo.jpg">
    <meta property="og:url" content="https://hangakobo.com/gallery/">
    <meta property="og:title" content="木版画ギャラリー | 版画ゆうびん舎">
    <meta property="og:description" content="心に残った風景、身近な動植物、変哲の無い日用品、天使や架空の動物たちなど、おさのなおこの木版画ポートフォリオ。">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
    <link rel="icon" href="/favicon.ico">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-L7RBWQL4BZ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-L7RBWQL4BZ');
    </script>
  </head>
  <body class="preloader" data-background-color="hsl(45, 50%, 90%)" oncontextmenu="return false;">
    <header id="header" class="header" data-active-header>
      <div class="header__inner">
        <div id="gNav" class="gNav">
          <div class="gNav__siteBrand" data-site-brand>
            <a href="/">
              <img src="/assets/logo.png" alt="版画ゆうびん舎 ロゴ">
            </a>
          </div>
          <ul class="gNav__primaryMenu" data-primary-menu>
            <li class="gNav__menuItem"><a href="/posts/">版画ゆうびん</a></li>
            <li class="gNav__menuItem"><a href="/about/">制作に寄せて</a></li>
            <li class="gNav__menuItem"><a href="/info/">お知らせ</a></li>
            <li class="gNav__menuItem"><a href="/#products">商品のご案内</a></li>
            <li class="gNav__menuItem"><a href="/gallery/">木版画ギャラリー</a></li>
            <li class="gNav__menuItem"><a href="/studio/">版画教室</a></li>
            <li class="gNav__menuItem"><a href="/#links">リンク集</a></li>
            <li class="gNav__menuItem"><a href="/#contact">お問い合わせ</a></li>
          </ul>
          <ul class="gNav__socialMenu" data-social-menu>
            <li class="gNav__menuItem is-social">
              <a href="https://instagram.com/" target="_blank" rel="noopener">
                <svg class="icon is-instagram is-md" width="36" height="36" aria-hidden="true">
                  <use href="/assets/icons.svg#si-instagram"></use>
                </svg>
              </a>
            </li>
        </div>
      </div>
    </header>
    <main id="main" class="main">
      <div class="main__container">
        <header class="main__header">
          <h1 class="main__title">木版画ギャラリー</h1>
          <p class="main__lead">おさのなおこの木版画ポートフォリオ。</p>
        </header>
        <?php echo $cms->get_breadcrumb(); ?>
      </div>
      <div class="slider" data-gallery="slider" data-flickable data-aspect-ratio="0.5" data-gap="144">
        <figure class="slider__inner" data-gallery-main>
          <?php foreach ($cms->get_artworks() as $artwork) { ?>
            <?php if ($artwork['showOnGallery']) { ?>
              <figure class="slider__item" data-gallery-item>
                <img class="slider__image" src="/content/artworks/<?php echo $artwork['name']; ?>s.png" alt="<?php echo $artwork['title']; ?>">
                <figcaption class="slider__caption"><?php echo $artwork['title']; ?></figcaption>
              </figure>
            <?php } ?>
          <?php } ?>
        </figure>
      </div>
    </main>
    <div class="cover"></div>
    <footer id="footer" class="footer">
      <div class="footer__copyright"></div>
    </footer>
    <script src="/init.js" type="module"></script>
  </body>
</html>
