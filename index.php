<?php
// Hangakobo start!
require_once __DIR__ . '/inc/Hangakobo.php';
$cms = new Hangakobo();
?>

<!DOCTYPE html>
<html>
  <head prefix="og: https://ogp.me/ns#">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>版画ゆうびん舎 - 越前海岸から発信 おさのなおこの版画工房</title>
    <meta name="description" content="心に残った風景、身近な動植物、変哲の無い日用品、天使や架空の動物たちなど、おさのなおこの木版画ポートフォリオ。">
    <meta property="og:site_name" content="版画ゆうびん舎">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://hangakobo.com/content/ogp/2025-hangakobo.jpg">
    <meta property="og:url" content="https://hangakobo.com">
    <meta property="og:title" content="版画ゆうびん舎 - 越前海岸から発信 おさのなおこの版画工房">
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
          <h1 class="gNav__siteBrand" data-site-brand>
            <a href="/">
              <img src="/assets/logo.png" alt="版画ゆうびん舎 ロゴ">
            </a>
          </h1>
          <ul class="gNav__primaryMenu" data-primary-menu>
            <li class="gNav__menuItem"><a href="/#posts">版画ゆうびん</a></li>
            <li class="gNav__menuItem"><a href="/#about">制作に寄せて</a></li>
            <li class="gNav__menuItem"><a href="/#info">お知らせ</a></li>
            <li class="gNav__menuItem"><a href="/#products">商品のご案内</a></li>
            <li class="gNav__menuItem"><a href="/#gallery">木版画ギャラリー</a></li>
            <li class="gNav__menuItem"><a href="/#studio">版画教室</a></li>
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
      <header id="hero" class="hero">
        <figure id="artwork" class="hero__artwork">
          <img>
          <figcaption></figcaption>
        </figure>
      </header>
      <section id="posts" class="section">
        <div class="section__container">
          <h2 class="section__title">版画ゆうびん</h2>
          <ul class="postList is-list">
            <?php foreach ($cms->get_posts('posts', 1, 3) as $post) { ?>
              <li class="postList__item postItem">
                <figure class="postItem__image">
                  <a href="/posts/<?php echo $post['slug']; ?>/">
                    <img loading="razy" src="<?php echo $post['img'] ?>">
                  </a>
                </figure>
                <div class="postItem__content">
                  <div class="postItem__info">
                    <div class=postItem__date><?php echo date('Y.m.d',strtotime($post['date'])); ?></div>
                  </div>
                  <h3 class="postItem__heading">
                    <a href="/posts/<?php echo $post['slug']; ?>/">
                      <?php echo $post['title']; ?>
                    </a>
                  </h3>
                  <p class="postItem__excerpt">
                    <?php echo $post['summary']; ?>
                    <a class="postItem__more" href="/posts/<?php echo $post['slug']; ?>/">もっと詳しく &gt;</a>
                  </p>
                </div>
              </li>
            <?php } ?>
          </ul>
          <div class="my-medium text-center">
            <a href="/posts/">版画ゆうびんをもっと見る &gt;</a>
          </div>
        </div>
      </section>
      <section id="about" class="section">
        <div class="section__container">
          <h2 class="section__title">制作に寄せて</h2>
          <div class="mediaText">
            <figure class="mediaText__media">
              <img loading="razy" src="/content/artworks/artworkF033s.png" alt="海">
            </figure>
            <div class="mediaText__content">
              <p>版画のモチーフは、
                <br>心に残った風景、身近な動植物、
                <br>変哲の無い日用品、天使や架空の動物たち。
                <br>大切な方へお便りを出すような心地で、
                <br>一枚一枚制作しています。</p>
              <a class="button is-primary is-sm my-medium" href="/about/">もっと詳しく</a>
          </div>
        </div> 
      </section>
      <section id="info" class="section">
        <div class="section__container">
          <h2 class="section__title">お知らせ</h2>
          <ul class="postList is-list is-switched">
            <?php foreach ($cms->get_posts('info', 1, 3) as $post) { ?>
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
              <img loading="razy" id="clockImage" class="clock__image" src="/assets/clockImage.jpg">
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
                <a class="button is-secondary is-sm my-medium" href="https://www.iichi.com/listing/item/340160" target="_blank" rel="noopener">商品ページを見る</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="gallery" class="section">
        <div class="section__container">
          <h2 class="section__title">木版画ギャラリー</h2>
        </div>
        <div class="slider" data-gallery="slider" data-flickable data-aspect-ratio="0.5" data-gap="144">
          <figure class="slider__inner" data-gallery-main>
            <?php foreach ($cms->get_artworks() as $artwork) { ?>
              <?php if ($artwork['showOnFront']) { ?>
                <figure class="slider__item" data-gallery-item>
                  <img class="slider__image" src="/content/artworks/<?php echo $artwork['name']; ?>s.png" alt="<?php echo $artwork['title']; ?>">
                  <figcaption class="slider__caption"><?php echo $artwork['title']; ?></figcaption>
                </figure>
              <?php } ?>
            <?php } ?>
          </figure>
        </div>
        <div class="my-medium text-center">
          <a href="/gallery/">作品をもっと見る &gt;</a>
        </div>
      </section>
      <section id="studio" class="section">
        <div class="section__container">
          <h2 class="section__title">版画教室</h2>
          <div class="mediaText">
            <figure class="mediaText__media">
              <img loading="razy" src="/content/artworks/artworkM034s.png" alt="祈り">
            </figure>
            <div class="mediaText__content">
              <p>身近な題材をテーマに下絵を作成し、
                <br>比較的易しい技法でハガキサイズの素朴な作品を作っていく木版画講座です。
                <br>大切な方への手紙を添えるような気持ちで、
                <br>あなたも版画を制作してみませんか。</p>
              <a class="button is-primary is-sm my-medium" href="/studio/">もっと詳しく</a>
          </div>
        </div> 
      </section>
      <section id="links" class="section">
        <div class="section__container">
          <h2 class="section__title">リンク集</h2>
          <ul class="linkList">
            <?php foreach ($cms->get_posts('links') as $link) { ?>
            <li class="linkList__item">
              <a class="linkList__link" href="<?php echo $link['link']; ?>" target="_blank" rel="noopener" style="background-color:<?php echo $link['bg']; ?>;">
                <div class="linkList__inner" style="border-color:<?php echo $link['color']; ?>;">
                  <figure class="linkList__image">
                    <img loading="razy" src="<?php echo $link['img']; ?>" alt="<?php echo $link['title']; ?>">
                  </figure>
                  <div class="linkList__content" style="color:<?php echo $link['color']; ?>;">
                    <h3 class="linkList__title"><?php echo $link['title']; ?></h3>
                    <p class="linkList__summary"><?php echo $link['summary']; ?></p>
                  </div>
                </div>
              </a>
            </li>
            <?php } ?>
          </ul>
          <p class="text-center my-medium"><small>「いきものたち」「木版画の灯」は、現在制作休止中です。
            <br>作品アーカイブとしてお楽しみください。</small><p>
        </div>
      </section>  
      <section id="contact" class="section">
        <div class="section__container">
          <h2 class="section__title">お問い合わせ</h2>
          <p class="text-center">ご質問・ご相談などございましたら、下記のフォームよりお気軽にお問い合わせください。</p>
          <form class="form" data-contact-form>
            <table class="form__table">
              <tr>
                <th><label for="your-name">お名前<span class="is-required">*必須</span></label></th>
                <td><input id="your-name" size="30" type="text" name="お名前" required></td>
              </tr>
              <tr>
                <th><label for="your-email">メールアドレス<span class="is-required">*必須</span></label></th>
                <td><input id="your-email" size="30" type="email" name="Email" required></td>
              </tr>
              <tr>
                <th><label for="your-subject">件名</label></th>
                <td>
                  <select id="your-subject" name="件名">
                    <option value="版画教室・体験に関するお問い合わせ">版画教室・体験に関するお問い合わせ</option>
                    <option value="版画制作・作画に関するお問い合わせ">版画制作・作画に関するお問い合わせ</option>
                    <option value="ご質問・ご意見・その他">ご質問・ご意見・その他</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th><label for="your-message">メッセージ本文</label></th>
                <td><textarea id="your-message" name="メッセージ本文" cols="30" rows="6"></textarea></td>
              </tr>
            </table>
            <div class="form__buttons">
              <input class="button is-primary is-sm my-medium" type="submit" value="確認">
            </div>
          </form>
        </div>
      </section>
    </main>
    <div class="cover"></div>
    <footer id="footer" class="footer">
      <div class="footer__copyright"></div>
    </footer>
    <script src="/init.js" type="module"></script>
  </body>
</html>
