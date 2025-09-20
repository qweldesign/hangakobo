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
            <li class="gNav__menuItem"><a href="/#products">商品のご案内</a></li>
            <li class="gNav__menuItem"><a href="/gallery/">ギャラリー</a></li>
            <li class="gNav__menuItem"><a href="/workshop/">版画教室</a></li>
            <li class="gNav__menuItem"><a href="/#contact">お問い合わせ</a></li>
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
      <section id="products" class="section">
        <div class="section__container">
          <h2 class="section__title">商品のご案内</h2>
          <div id="clock" class="clock">
            <div id="clockBase" class="clock__base">
              <img id="clockImage" class="clock__image" src="/assets/clockImage.jpg">
              <canvas id="clockMain" class="clock__main" width="240" height="240"></canvas>
              <div id="clockBalloon" class="clock__balloon"></div>
            </div>
            <div class="clock__section">
              <h3>腹時計</h3>
              <div class="clock__description">
                <p>「ねこさん、ねこさん、風呂敷下げてどこ行くの？」
                  <br>「風にまかせて、気分にまかせて、どこまでも。
                  <br>お腹の時計がグーッと鳴ったら、
                  <br>そこでお弁当広げて食べるのさ。」</p>
                <p>木版画らしい猫の毛並みや目つきが特徴的な一品。
                  <br>毎日の時を刻む、暮らしの相棒。</p>
              </div>
              <div class="clock__more">
                <a class="button button--primary button--sm my-medium" href="https://www.iichi.com/listing/item/340160" target="_blank" rel="noopener">商品ページを見る</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="contact" class="section">
        <div class="section__container">
          <h2 class="section__title">お問い合わせ</h2>
          <p class="text-center">ご質問・ご相談などございましたら、下記のフォームよりお気軽にお問い合わせください。</p>
          <form class="form" action="/inc/mail.php" method="POST">
            <table class="form__table">
              <tr>
                <th><label for="yourname">氏名<span class="is-required">*必須</span></label></th>
                <td><input id="yourname" size="30" type="text" name="氏名" required></td>
              </tr>
              <tr>
                <th><label for="youremail">メールアドレス<span class="is-required">*必須</span></label></th>
                <td><input id="youremail" size="30" type="email" name="Email" required></td>
              </tr>
              <tr>
                <th><label for="yoursubject">題名</label></th>
                <td>
                  <select id="yoursubject" name="題名">
                    <option value="ご質問・お問い合わせ">ご質問・お問い合わせ</option>
                    <option value="その他">その他</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th><label for="yourcontent">メッセージ本文</label></th>
                <td><textarea id="yourcontent" name="メッセージ本文" cols="30" rows="6"></textarea></td>
              </tr>
            </table>
            <div class="form__buttons">
              <input class="button button--primary button--sm my-medium" type="submit" value="確認">
            </div>
          </form>
        </div>
    </main>
    <div class="cover"></div>
    <footer id="footer" class="footer">
      <small class="footer__copyright"></small>
    </footer>
    <script src="/init.js" type="module"></script>
  </body>
</html>
