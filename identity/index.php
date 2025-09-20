<?php
require_once dirname(__DIR__) . '/inc/blog.php';
require_once dirname(__DIR__) . '/inc/parsedown.php';
$Parsedown = new Parsedown();

$dir   = dirname(__DIR__) . '/content/identity/';
$posts = load_all_articles($dir);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>制作に寄せて | 版画ゆうびん舎</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
    <link rel="icon" href="/favicon.ico">
  </head>
  <body>
    <header id="header" class="header">
      <div class="header__inner">
        <div id="gNav" class="gNav">
          <div class="gNav__siteBrand">
            <a href="/">
              <img src="/assets/logo.png" alt="版画ゆうびん舎 ロゴ">
            </a>
          </div>
          <ul class="gNav__primaryMenu">
            <li class="gNav__menuItem"><a href="/letters/">版画ゆうびん</a></li>
            <li class="gNav__menuItem"><a href="/identity/">制作に寄せて</a></li>
            <li class="gNav__menuItem"><a href="/info/">お知らせ</a></li>
            <li class="gNav__menuItem"><a href="/products/">商品のご案内</a></li>
            <li class="gNav__menuItem"><a href="/gallery/">ギャラリー</a></li>
            <li class="gNav__menuItem"><a href="/workshop/">版画教室</a></li>
            <li class="gNav__menuItem"><a href="/cotact/">お問い合わせ</a></li>
          </ul>
          <ul class="gNav__socialMenu">
            <li class="gNav__menuItem gNav__menuItem--social">
              <a href="https://instagram.com/osanonaoko/" target="_blank" rel="noopener">
                <svg class="icon icon--si icon--instagram icon--md" width="36" height="36" aria-hidden="true">
                  <use href="/assets/icons.svg#si-instagram"></use>
                </svg>
              </a>
            </li>
        </div>
      </div>
    </header>
    <main id="main" class="main">
      <header class="main__header">
        <h1 class="main__title">制作に寄せて</h1>
      </header>
      <ul id="breadcrumb" class="breadcrumb">
        <li class="breadcrumb__item">
          <a href="/">Top</a>
        </li>
        <li class="breadcrumb__item is-current">
          <span>制作に寄せて</span>
        </li>
      </ul>
      <div class="main__content">
        <section class="main__section">
          <?php foreach ($posts as $post) { ?>
            <section class="mediaText">
              <figure class="mediaText__media">
                <img src="<?php echo $post['img'] ?>">
              </figure>
              <div class="mediaText__content">
                <h2 class="mediaText__title"><?php echo $post['title']; ?></h2>
                <?php echo $Parsedown->text($post['content']); ?>
              </div>
            </section>
          <?php } ?>
        </section>
      </div>
    </main>
    <div class="cover"></div>
    <footer id="footer" class="footer">
      <small class="footer__copyright"></small>
    </footer>
    <script src="/init.js" type="module"></script>
  </body>
</html>
