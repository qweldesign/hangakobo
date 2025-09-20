<?php
require_once dirname(__DIR__) . '/inc/blog.php';
require_once dirname(__DIR__) . '/inc/parsedown.php';
$Parsedown = new Parsedown();

$dir   = dirname(__DIR__) . '/content/letters/';
$slug  = $_GET['slug'] ?? null;
$count = (int)($_GET['count'] ?? 10);
$page  = (int)($_GET['page'] ?? 1);

$posts = load_all_articles($dir);
$posts = array_slice($posts, $count * ($page - 1), $count);

if ($slug) {
  $post = find_article_by_slug($slug, $dir);
  if (!$post) {
    $content = "<h2>記事が見つかりません</h2><p>指定された記事は存在しないか、削除された可能性があります。</p>";
  }
  $content = $Parsedown->text($post['content']);
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>越前海岸からの版画ゆうびん | 版画ゆうびん舎</title>
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
            <li class="gNav__menuItem"><a href="/#products">商品のご案内</a></li>
            <li class="gNav__menuItem"><a href="/#gallery">ギャラリー</a></li>
            <li class="gNav__menuItem"><a href="/#links">リンク集</a></li>
            <li class="gNav__menuItem"><a href="/#contact">お問い合わせ</a></li>
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
      <div class="main__container">
        <header class="main__header">
          <h1 class="main__title">版画ゆうびん</h1>
          <p class="main__lead">おさのなおこが綴る越前海岸からの版画の便り</p>
        </header>
        <ul id="breadcrumb" class="breadcrumb">
          <li class="breadcrumb__item">
            <a href="/">Top</a>
          </li>
          <?php if ($slug !== 'about' && $post) { ?>
            <li class="breadcrumb__item">
              <a href="/letters/">版画ゆうびん</a>
            </li>
            <li class="breadcrumb__item is-current">
              <span><?php echo $post['title']; ?></span>
            </li>
          <?php } else { ?>
            <li class="breadcrumb__item is-current">
              <span>版画ゆうびん</span>
            </li>
          <?php } ?>
        </ul>
        <div class="main__content">
          <?php if (!$slug) { ?>
            <ul class="postList postList--list">
              <?php foreach ($posts as $post) { ?>
                <li class="postList__item postItem">
                  <figure class="postItem__image">
                    <a href="/letters/<?php echo $post['slug']; ?>/">
                      <img loading="razy" src="<?php echo $post['img'] ?>">
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
          <?php } else { ?>
            <article class="main__article">
              <div class="main__date"><?php echo date('Y.m.d',strtotime($post['date'])); ?></div>
              <?php echo $Parsedown->text($content); ?>
            </article>
            <aside class="main__aside">
              <h2 class="main__heading">最新の版画ゆうびん</h2>
              <ul class="postIndex">
                <?php foreach ($posts as $post) { ?>
                  <li class="postIndex__item">
                    <a href="/letters/<?php echo $post['slug']; ?>/">
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
      <small class="footer__copyright"></small>
    </footer>
    <script src="/init.js" type="module"></script>
  </body>
</html>
