<?php
/**
 * トップページ
 * ヒーロー (作品をランダムに表示), 版画ゆうびん・お知らせの最新記事, 各ページの紹介,
 * 商品のご案内, 木版画ギャラリー, リンク集, お問い合わせフォームを並べる
 * 一覧・個別記事は投稿タイプのディレクトリ (posts/, info/, page/) が表示する
 */
require_once __DIR__ . '/inc/templates/postList.php';
require_once __DIR__ . '/inc/templates/gallery.php';
require_once __DIR__ . '/inc/templates/contact.php';

// トップに並べる記事の件数
const HOME_POST_COUNT = 3;

$posts = content_engine('posts', ['slug' => null, 'page' => 1])->get_posts(1, HOME_POST_COUNT);
$info  = content_engine('info', ['slug' => null, 'page' => 1])->get_posts(1, HOME_POST_COUNT);
$links = (new ContentLoader(__DIR__ . '/' . SITE_LINKS_DIR))->load();

render_header([
  'full_title' => SITE_HOME_TITLE,
  'path'       => '',
  'type'       => 'website',
  'home'       => true,
  'preloader'  => true,
]);
?>
    <main id="main" class="main">
      <header id="hero" class="hero">
        <figure id="artwork" class="hero__artwork">
          <img alt="">
          <figcaption></figcaption>
        </figure>
      </header>
      <section id="posts" class="section">
        <div class="section__container">
          <h2 class="section__title"><?= e(post_type('posts')['label']) ?></h2>
<?php render_post_list($posts, 'posts'); ?>
          <div class="my-medium text-center">
            <a href="<?= e(type_url('posts')) ?>"><?= e(post_type('posts')['label']) ?>をもっと見る &gt;</a>
          </div>
        </div>
      </section>
      <section id="about" class="section">
        <div class="section__container">
          <h2 class="section__title">制作に寄せて</h2>
          <div class="mediaText">
            <figure class="mediaText__media">
              <img loading="lazy" src="<?= e(path(SITE_ARTWORKS_DIR . '/artworkF033s.png')) ?>" alt="海">
            </figure>
            <div class="mediaText__content">
              <p>版画のモチーフは、
                <br>心に残った風景、身近な動植物、
                <br>変哲の無い日用品、天使や架空の動物たち。
                <br>大切な方へお便りを出すような心地で、
                <br>一枚一枚制作しています。</p>
              <a class="button is-primary is-sm my-medium" href="<?= e(path('page/about/')) ?>">もっと詳しく</a>
            </div>
          </div>
        </div>
      </section>
      <section id="info" class="section">
        <div class="section__container">
          <h2 class="section__title"><?= e(post_type('info')['label']) ?></h2>
<?php render_post_list($info, 'info', ['switched' => true]); ?>
          <div class="my-medium text-center">
            <a href="<?= e(type_url('info')) ?>"><?= e(post_type('info')['label']) ?>をもっと見る &gt;</a>
          </div>
        </div>
      </section>
      <section id="products" class="section">
        <div class="section__container">
          <h2 class="section__title">商品のご案内</h2>
          <div id="clock" class="clock">
            <div id="clockBase" class="clock__base">
              <img id="clockImage" class="clock__image" src="<?= e(path('assets/clockImage.jpg')) ?>" alt="腹時計">
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
<?php render_artwork_slider('showOnFront'); ?>
        <div class="my-medium text-center">
          <a href="<?= e(path('gallery/')) ?>">作品をもっと見る &gt;</a>
        </div>
      </section>
      <section id="studio" class="section">
        <div class="section__container">
          <h2 class="section__title">版画教室</h2>
          <div class="mediaText">
            <figure class="mediaText__media">
              <img loading="lazy" src="<?= e(path(SITE_ARTWORKS_DIR . '/artworkM034s.png')) ?>" alt="祈り">
            </figure>
            <div class="mediaText__content">
              <p>身近な題材をテーマに下絵を作成し、
                <br>比較的易しい技法でハガキサイズの素朴な作品を作っていく木版画講座です。
                <br>大切な方への手紙を添えるような気持ちで、
                <br>あなたも版画を制作してみませんか。</p>
              <a class="button is-primary is-sm my-medium" href="<?= e(path('page/studio/')) ?>">もっと詳しく</a>
            </div>
          </div>
        </div>
      </section>
      <section id="links" class="section">
        <div class="section__container">
          <h2 class="section__title">リンク集</h2>
          <ul class="linkList">
<?php foreach ($links as $link) { ?>
            <li class="linkList__item">
              <a class="linkList__link" href="<?= e($link['link'] ?? '') ?>" target="_blank" rel="noopener" style="background-color:<?= e($link['bg'] ?? '') ?>;">
                <div class="linkList__inner" style="border-color:<?= e($link['color'] ?? '') ?>;">
                  <figure class="linkList__image">
                    <img loading="lazy" src="<?= e(path($link['img'] ?? '')) ?>" alt="<?= e($link['title'] ?? '') ?>">
                  </figure>
                  <div class="linkList__content" style="color:<?= e($link['color'] ?? '') ?>;">
                    <h3 class="linkList__title"><?= e($link['title'] ?? '') ?></h3>
                    <p class="linkList__summary"><?= e($link['summary'] ?? '') ?></p>
                  </div>
                </div>
              </a>
            </li>
<?php } ?>
          </ul>
          <p class="text-center my-medium"><small>「いきものたち」「木版画の灯」は、現在制作休止中です。
            <br>作品アーカイブとしてお楽しみください。</small></p>
        </div>
      </section>
      <section id="contact" class="section">
        <div class="section__container">
          <h2 class="section__title"><?= e(SITE_CONTACT['title']) ?></h2>
<?php render_contact_form(); ?>
        </div>
      </section>
    </main>
<?php render_footer(); ?>
