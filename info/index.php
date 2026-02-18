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
    <?php if ($cms->is_single()) { ?>
      <title><?php echo $cms->article['title'] . ' | '; ?>お知らせ | 版画ゆうびん舎</title>
      <meta name="description" content="<?php echo $cms->article['summary']; ?>">
    <?php } else { ?>
      <title>お知らせ | 版画ゆうびん舎</title>
      <meta name="description" content="版画ゆうびん舎 おさのなおこの展示会の予定・制作実績など">
    <?php } ?>
    <meta property="og:site_name" content="版画ゆうびん舎">
    <meta property="og:type" content="blog">
    <meta property="og:image" content="https://hangakobo.com/content/ogp/2025-hangakobo.jpg">
    <?php if ($cms->is_single()) { ?>
      <meta property="og:url" content="https://hangakobo.com/info/<?php echo $cms->article['slug']; ?>/">
      <meta property="og:title" content="<?php echo $cms->article['title'] . ' | '; ?>お知らせ | 版画ゆうびん舎">
      <meta property="og:description" content="<?php echo $cms->article['summary']; ?>">
    <?php } else { ?>
      <meta property="og:url" content="https://hangakobo.com/info/">
      <meta property="og:title" content="お知らせ | 版画ゆうびん舎">
      <meta property="og:description" content="版画ゆうびん舎 おさのなおこの展示会の予定・制作実績など">
    <?php } ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@500;700&display=swap" rel="stylesheet">
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
  <body oncontextmenu="return false;">
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
              <a href="https://instagram.com/osanonaoko/" target="_blank" rel="noopener">
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
          <h1 class="main__title">お知らせ</h1>
          <p class="main__lead">おさのなおこの展示会の予定・制作実績など</p>
        </header>
        <?php echo $cms->get_breadcrumb(); ?>
        <div class="main__content">
          <?php if (!$cms->is_single()) { ?>
            <ul class="postList is-list">
              <?php foreach ($cms->get_posts() as $post) { ?>
                <li class="postList__item postItem">
                  <figure class="postItem__image">
                    <a href="/info/<?php echo $post['slug']; ?>/">
                      <img loading="razy" src="<?php echo $post['img'] ?>">
                    </a>
                  </figure>
                  <div class="postItem__content">
                    <div class="postItem__info">
                      <div class=postItem__date><?php echo date('Y.m.d',strtotime($post['date'])); ?></div>
                    </div>
                    <h3 class="postItem__heading">
                      <a href="/info/<?php echo $post['slug']; ?>/">
                        <?php echo $post['title']; ?>
                      </a>
                    </h3>
                    <p class="postItem__excerpt">
                      <?php echo $post['summary']; ?>
                      <a class="postItem__more" href="/info/<?php echo $post['slug']; ?>/">もっと詳しく &gt;</a>
                    </p>
                  </div>
                </li>
              <?php } ?>
            </ul>
            <?php echo $cms->pagination(); ?>
          <?php } else { ?>
            <article class="main__article">
              <div class="main__date"><?php echo date('Y.m.d',strtotime($cms->article['date'])); ?></div>
              <?php echo $cms->text($cms->article['content']); ?>
            </article>
            <aside class="main__aside">
              <h2 class="main__heading">最新の版画ゆうびん</h2>
              <ul class="postIndex">
                <?php foreach ($cms->get_posts('posts', 1, 4) as $post) { ?>
                  <li class="postIndex__item">
                    <a href="/posts/<?php echo $post['slug']; ?>/">
                      <img loading="razy" class="postIndex__image" src="<?php echo $post['img']; ?>">
                      <span class="postIndex__date"><?php echo date('Y.m.d',strtotime($post['date'])); ?></span>
                      <span class="postIndex__title"><?php echo $post['title']; ?></span>
                    </a>
                  </li>
                <?php } ?>
              </ul>
              <h2 class="main__heading">最新のお知らせ</h2>
              <ul class="postIndex">
                <?php foreach ($cms->get_posts('info', 1, 4) as $post) { ?>
                  <li class="postIndex__item">
                    <a href="/info/<?php echo $post['slug']; ?>/">
                      <img loading="razy" class="postIndex__image" src="<?php echo $post['img']; ?>">
                      <span class="postIndex__date"><?php echo date('Y.m.d',strtotime($post['date'])); ?></span>
                      <span class="postIndex__title"><?php echo $post['title']; ?></span>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </aside>
          <?php } ?>
        </div>
      </div>
    </main>
    <div class="cover"></div>
    <footer id="footer" class="footer">
      <div class="footer__copyright"></div>
    </footer>
    <script src="/init.js" type="module"></script>
  </body>
</html>
