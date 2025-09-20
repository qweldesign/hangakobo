<?php
require_once __DIR__ . '/inc/blog.php';

$dir1   = __DIR__ . '/content/letters/';
$dir2   = __DIR__ . '/content/info/';

$posts1 = load_all_articles($dir1);
$posts2 = load_all_articles($dir2);
$posts1 = array_slice($posts1, 0, 3);
$posts2 = array_slice($posts2, 0, 3);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>越前海岸からの版画ゆうびん | 版画ゆうびん舎</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
    <link rel="icon" href="/favicon.ico">
  </head>
  <body>
    <header id="header" class="header">
      <div class="header__inner">
        <div id="gNav" class="gNav">
          <h1 class="gNav__siteBrand">
            <a href="/">
              <img src="/assets/logo.png" alt="版画ゆうびん舎 ロゴ">
            </a>
          </h1>
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
              <a href="https://instagram.com/" target="_blank" rel="noopener">
                <svg class="icon icon--si icon--instagram icon--md" width="36" height="36" aria-hidden="true">
                  <use href="/assets/icons.svg#si-instagram"></use>
                </svg>
              </a>
            </li>
        </div>
      </div>
    </header>
    <main id="main" class="main">
      <header id="hero" class="hero">
        <figure id="artwork" class="hero__artwork">
          <img>
          <figcaption></figcaption>
        </figure>
      </header>
      <section id="letters" class="section">
        <div class="section__container">
          <h2 class="section__title">版画ゆうびん</h2>
          <ul class="postList postList--list">
            <?php foreach ($posts1 as $post) { ?>
              <li class="postList__item postItem">
                <figure class="postItem__image">
                  <a href="/letters/<?php echo $post['slug']; ?>/">
                    <img src="<?php echo $post['img'] ?>">
                  </a>
                </figure>
                <div class="postItem__content">
                  <div class="postItem__info">
                    <div class=postItem__date><?php echo date('Y.m.d',strtotime($post['date'])); ?></div>
                  </div>
                  <h3 class="postItem__heading">
                    <a href="/letters/<?php echo $post['slug']; ?>/">
                      <?php echo $post['title']; ?>
                    </a>
                  </h3>
                  <p class="postItem__excerpt">
                    <?php echo $post['summary']; ?>
                    <a class="postItem__more" href="/letters/<?php echo $post['slug']; ?>/">もっと詳しく &gt;</a>
                  </p>
                </div>
              </li>
            <?php } ?>
          </ul>
          <div class="my-medium text-center">
            <a href="/letters/">版画ゆうびんをもっと見る &gt;</a>
          </div>
        </div>
      </section>
      <section id="identity" class="section">
        <div class="section__container">
          <h2 class="section__title">制作に寄せて</h2>
          <div class="mediaText">
            <figure class="mediaText__media">
              <img src="/content/artworks/artworkM094s.png" alt="至上善">
            </figure>
            <div class="mediaText__content">
              <p>版画のモチーフは、
                <br>心に残った風景、身近な動植物、
                <br>変哲の無い日用品、天使や架空の動物たち。
                <br>版画作品を日々の暮らしの傍らに、
                <br>そっと置いて欲しいと願い、
                <br>制作しています。</p>
              <a class="button button--primary button--sm my-medium" href="/identity/">もっと詳しく</a>
          </div>
        </div> 
      </section>
      <section id="info" class="section">
        <div class="section__container">
          <h2 class="section__title">お知らせ</h2>
          <ul class="postList postList--list is-switched">
            <?php foreach ($posts2 as $post) { ?>
              <li class="postList__item postItem">
                <figure class="postItem__image">
                  <a href="/letters/<?php echo $post['slug']; ?>/">
                    <img src="<?php echo $post['img'] ?>">
                  </a>
                </figure>
                <div class="postItem__content">
                  <div class="postItem__info">
                    <div class=postItem__date><?php echo date('Y.m.d',strtotime($post['date'])); ?></div>
                  </div>
                  <h3 class="postItem__heading">
                    <a href="/letters/<?php echo $post['slug']; ?>/">
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
          <div class="my-medium text-center">
            <a href="/info/">お知らせをもっと見る &gt;</a>
          </div>
        </div>
      </section>
    </main>
    <div class="cover"></div>
    <footer id="footer" class="footer">
      <small class="footer__copyright"></small>
    </footer>
    <script src="/init.js" type="module"></script>
  </body>
</html>
