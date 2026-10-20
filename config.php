<?php
/**
 * サイトの設定
 * サイト名や URL, 投稿タイプなど, サイトごとに変わる値はここにまとめる
 * (inc/ 以下のエンジン・テンプレートには, サイト固有の値を書かない)
 */

// 日付の判定・表示のタイムゾーン
date_default_timezone_set('Asia/Tokyo');

// サイト名 (<title> の「記事タイトル | サイト名」と og:site_name に使う)
const SITE_NAME = '版画ゆうびん舎';
// トップページの <title>
const SITE_HOME_TITLE = '版画ゆうびん舎 - 越前海岸から発信 おさのなおこの版画工房';
// サイトの URL (末尾のスラッシュなし. OGP, canonical の絶対URLに使う)
const SITE_URL = 'https://hangakobo.com';
// サイトのルートのパス (ドメイン直下なら '/'. 例: /tools/simple-cms/ に置く場合)
const SITE_ROOT = '/';
// サイトの説明 (description の既定値)
const SITE_DESCRIPTION = '心に残った風景、身近な動植物、変哲の無い日用品、天使や架空の動物たちなど、おさのなおこの木版画ポートフォリオ。';
// OGP 画像の既定値 (サイトのルートからのパス)
const SITE_OGP_IMAGE = 'content/ogp/2025-hangakobo.jpg';
// 記事一覧のサムネイルの既定値 (記事にアイキャッチがない場合)
const SITE_THUMBNAIL_IMAGE = 'assets/ogp.jpg';
// Google Fonts などの読み込み (不要なら空文字)
const SITE_FONTS_URL = 'https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@400;500;700&display=swap';
// 言語
const SITE_LANG = 'ja';
// Google アナリティクスの測定 ID (不要なら空文字)
const SITE_GA_ID = 'G-L7RBWQL4BZ';
// 右クリックのメニューを出さない (画像の保存をしにくくする)
const SITE_DISABLE_CONTEXT_MENU = true;
// 読み込み中の画面 (js/preloader.js) の背景色
const SITE_PRELOADER_COLOR = 'hsl(45, 50%, 90%)';

// ヘッダーのロゴ (画像のパスとリンク先. 画像がなければ SITE_NAME を文字で出す)
const SITE_LOGO = 'assets/logo.png';
const SITE_LOGO_ALT = '版画ゆうびん舎 ロゴ';
const SITE_LOGO_LINK = '';

/**
 * ヘッダーのナビ
 * label: 表示名
 * path: リンク先 (サイトのルートからのパス. トップページの中の位置は '#xxx')
 * anchor: トップページでは, この id の位置へのリンクにする (省略するとトップページでも path)
 */
const SITE_NAV = [
  ['label' => '版画ゆうびん',     'path' => 'posts/',        'anchor' => 'posts'],
  ['label' => '制作に寄せて',     'path' => 'page/about/',   'anchor' => 'about'],
  ['label' => 'お知らせ',         'path' => 'info/',         'anchor' => 'info'],
  ['label' => '商品のご案内',     'path' => '#products',     'anchor' => 'products'],
  ['label' => '木版画ギャラリー', 'path' => 'gallery/',      'anchor' => 'gallery'],
  ['label' => '版画教室',         'path' => 'page/studio/',  'anchor' => 'studio'],
  ['label' => 'リンク集',         'path' => '#links',        'anchor' => 'links'],
  ['label' => 'お問い合わせ',     'path' => '#contact',      'anchor' => 'contact'],
];

// パンくずの先頭の階層 (path はサイトのルートからのパス, または http から始まる URL)
const SITE_BREADCRUMB = [
  ['label' => 'Top', 'path' => ''],
];

// ヘッダーの SNS など (url は http から始まる URL, またはサイトのルートからのパス. icon は icons.svg の symbol の id)
const SITE_SNS = [
  ['label' => 'Instagram', 'url' => 'https://instagram.com/osanonaoko/', 'icon' => 'si-instagram'],
];

// 著作権表示 (開始年 - 今年 運営者) と, その下の注意書き (HTML 可)
const SITE_OWNER = 'Osano Naoko';
const SITE_START_YEAR = 2007;
const SITE_COPYRIGHT_NOTE = '<p><span>警告:</span> 当サイトに掲載の全ての画像・文章・デザイン・レイアウトは著作権法により保護されています。著作権者の許諾を得ずに複製、転載、加工、頒布、販売することを禁じます。違反した場合、民事・刑事上の責任を追及します。使用許可は事前に書面で取得してください。<br><span>Warning:</span> All images, text, designs, and layouts on this website are protected under copyright law. Any reproduction, redistribution, modification, distribution, or sale without the copyright holder’s permission is strictly prohibited. In the event of a violation, civil and criminal liability will be pursued. Written permission must be obtained in advance for any use.</p>';

/**
 * 投稿タイプ
 * キー: 投稿タイプの名前
 * label: 表示名 (一覧の見出し, パンくず)
 * title: 一覧の <title> (個別記事は「記事タイトル | title」. 規定で label)
 * path: 一覧の URL (サイトのルートからのパス. 同じ名前のディレクトリに index.php と .htaccess を置く)
 * dir: Markdown を置くディレクトリ (サイトのルートからのパス)
 * list: 一覧ページをサイトマップに載せるか (規定で true)
 * breadcrumb: パンくずに一覧の階層を出すか (規定で true)
 * count: 一覧の1ページあたりの件数 (null で全件)
 * show_date: 日付を表示するか
 * lead: 一覧の見出しの下の文
 * description: 一覧の description (規定で lead)
 * aside: 個別記事の横に最新記事を並べる投稿タイプ (規定で自分だけ. 空の配列で出さない)
 */
const SITE_POST_TYPES = [
  'posts' => [
    'label'       => '版画ゆうびん',
    'title'       => '越前海岸からの版画ゆうびん',
    'path'        => 'posts/',
    'dir'         => 'content/posts',
    'count'       => 10,
    'show_date'   => true,
    'lead'        => 'おさのなおこが綴る越前海岸からの版画の便り',
    'description' => '版画ゆうびん舎 おさのなおこが綴る越前海岸からの版画の便り',
    'aside'       => ['posts', 'info'],
  ],
  'info' => [
    'label'       => 'お知らせ',
    'path'        => 'info/',
    'dir'         => 'content/info',
    'count'       => 10,
    'show_date'   => true,
    'lead'        => 'おさのなおこの展示会の予定・制作実績など',
    'description' => '版画ゆうびん舎 おさのなおこの展示会の予定・制作実績など',
    'aside'       => ['posts', 'info'],
  ],
  // 固定ページ (制作に寄せて, 版画教室)
  // frontmatter の sections に content/ のディレクトリ名を書くと, その中の Markdown を画像付きの段落として本文の後に並べる
  'page' => [
    'label'      => '固定ページ',
    'path'       => 'page/',
    'dir'        => 'content/page',
    'list'       => false,
    'breadcrumb' => false,
    'count'      => null,
    'show_date'  => false,
    'aside'      => [],
  ],
];

// URL の形式 (false: ?slug=xxx, ?page=2 / true: xxx/, page/2/ ※ .htaccess のリライトが必要)
const SITE_PRETTY_URLS = true;

// 投稿タイプ以外のページ (サイトのルートからのパス. サイトマップに載せる)
const SITE_PAGES = [
  'gallery/',
];

// トップページ・ギャラリーの設定 (サイトのルートからのパス)
// 作品の一覧 (name, title, showOnFront, showOnGallery) と画像のディレクトリ (画像は {name}s.png)
const SITE_ARTWORKS = 'content/artworks.json';
const SITE_ARTWORKS_DIR = 'content/artworks';
// リンク集の Markdown (frontmatter: title, link, img, bg, color, summary)
const SITE_LINKS_DIR = 'content/links';

/**
 * お問い合わせフォーム (入力: トップページの #contact, 確認・完了: /contact/confirm/, /contact/thanks/)
 * SMTP のパスワードなど秘密の値は inc/.env に書く (inc/.env.example を参照)
 *
 * path: フォームの URL (サイトのルートからのパス. 同じ名前のディレクトリに index.php, confirm/, thanks/ を置く. 送信は api/send.php)
 * form_url: 入力画面を別の場所 (トップページのセクションなど) に置く場合の URL (サイトのルートからのパス)
 * title: ページのタイトル
 * lead: フォームの上の説明文 (HTML 可)
 * interval: 同じ人 (セッション) が続けて送信できるまでの秒数 (0 で制限しない)
 * reply_footer: 自動返信メールの末尾に付ける文
 * env: .env の場所 (公開ディレクトリの外に置く場合は, このパスを書き換える)
 */
const SITE_CONTACT = [
  'path'         => 'contact/',
  'form_url'     => '#contact',
  'title'        => 'お問い合わせ',
  'lead'         => 'ご質問・ご相談などございましたら、下記のフォームよりお気軽にお問い合わせください。',
  'interval'     => 60,
  'reply_footer' => "
後日ご返信致しますので今しばらくお待ちください。

────────────────────────────────────────────────
版画ゆうびん舎

おさの なおこ (代表)
────────────────────────────────────────────────
",
  'env'          => __DIR__ . '/inc/.env',
];

/**
 * お問い合わせフォームの項目 (キーが name 属性. 並び順に表示する)
 * label: 項目名 (確認画面とメール本文にも使う)
 * type: text, email, tel, url, textarea, select, radio, checkbox
 *       (email の最初の項目を, 自動返信の宛先と管理者宛メールの返信先にする)
 * required: 必須か
 * options: select, radio, checkbox の選択肢
 * placeholder, autocomplete: 入力欄の属性 (任意)
 */
const SITE_CONTACT_FIELDS = [
  'name' => [
    'label'        => 'お名前',
    'type'         => 'text',
    'required'     => true,
    'autocomplete' => 'name',
  ],
  'email' => [
    'label'        => 'メールアドレス',
    'type'         => 'email',
    'required'     => true,
    'autocomplete' => 'email',
  ],
  'subject' => [
    'label'   => '件名',
    'type'    => 'select',
    'options' => ['版画教室・体験に関するお問い合わせ', '版画制作・作画に関するお問い合わせ', 'ご質問・ご意見・その他'],
  ],
  'message' => [
    'label'    => 'メッセージ本文',
    'type'     => 'textarea',
    'required' => true,
  ],
];
