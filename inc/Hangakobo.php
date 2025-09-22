<?php
require_once __DIR__ . '/ContentLoader.php';
require_once __DIR__ . '/ContentNavigation.php';
require_once __DIR__ . '/Parsedown.php';

class Hangakobo {
  public function __construct() {
    $this->slug  = $_GET['slug'] ?? null;
    $this->count = (int)($_GET['count'] ?? 10);
    $this->page  = (int)($_GET['page'] ?? 1);

    $class = $this->get_page();

    // トップ階層では、最新3件の記事を取得する
    if ($class === 'top') {
      $this->count = 3;
      $this->page  = 1;
    }

    // 個別記事では、最新4件の記事を取得する
    if ($this->slug) {
      $this->count = 4;
      $this->page  = 1;
    }

    // トップ階層、「版画ゆうびん」、「お知らせ」では、posts と info から記事を取得
    if ($class === 'top' || $class === 'posts' || $class == 'info') {
      $postsDir    = dirname(__DIR__) . '/content/posts/';
      $infoDir     = dirname(__DIR__) . '/content/info/';
      $postsLoader = new ContentLoader($postsDir);
      $infoLoader  = new ContentLoader($infoDir);
      // posts記事取得
      $this->posts      = $postsLoader->load();
      $this->postsCount = count($this->posts);
      $this->posts      = array_slice($this->posts, $this->count * ($this->page - 1), $this->count);
      // info記事取得
      $this->info      = $infoLoader->load();
      $this->infoCount = count($this->info);
      $this->info      = array_slice($this->info, $this->count * ($this->page - 1), $this->count);
    }
    
    // トップ階層では、links も取得
    if ($class === 'top') {
      $linksDir    = dirname(__DIR__) . '/content/links/';
      $linksLoader = new ContentLoader($linksDir);
      // links全取得
      $this->links = $linksLoader->load();
    }

    // 「制作に寄せて」では、identity から記事を取得
    if ($class === 'identity') {
      $identityDir    = dirname(__DIR__) . '/content/identity/';
      $identityLoadar = new ContentLoader($identityDir);
      // identity全取得
      $this->identity = $identityLoadar->load();
    }

    // トップ階層と「木版画ギャラリー」では、artworks.jsonも読み込む
    if ($class === 'top' || $class === 'gallery') {
      $jsonDir = dirname(__DIR__) . '/content/artworks.json';
      $json    = file_get_contents($jsonDir);
      // artworks.json
      $this->artworks = json_decode($json, true);
      $this->artworks = array_reverse($this->artworks);
    }

    // $this->slugがあれば、個別記事を読み込む
    if ($this->slug && $class === 'posts') {
      $this->article = $postsLoader->find($this->slug);
    } else if ($this->slug && $class === 'info') {
      $this->article = $infoLoader->find($this->slug);
    } else {
      $this->article = null;
    }
	}

  public function breadcrumb(array $article = null): string {
    $class = $this->get_page();

    if ($class === 'posts') $subdirLabel = '版画ゆうびん';
    if ($class === 'identity') $subdirLabel = '制作に寄せて';
    if ($class === 'info') $subdirLabel = 'お知らせ';
    if ($class === 'gallery') $subdirLabel = '木版画ギャラリー';

    $subdirPath = '/' . $class . '/';

    $nav = new ContentNavigation([
      'subdirLabel' => $subdirLabel,
      'subdirPath'  => $subdirPath
    ]);

    return $nav->breadcrumb($article);
  }

  public function pagination(): string {
    $class = $this->get_page();
    $currentPage = $this->page;

    if ($class === 'posts') $count = $this->postsCount;
    else if ($class === 'info') $count = $this->infoCount;
    else return '';
    $totalPages  = ceil($count / $this->count);

    $nav = new ContentNavigation();

    return $nav->pagination($currentPage, $totalPages);
  }

  public function text($text) {
    $parsedown = new Parsedown();
    return $parsedown->text($text);
  }

  protected function get_page(): string {
    // REQUEST_URI からクエリ文字列を除去
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // 前後のスラッシュを除去して / で分割
    $parts = explode('/', trim($uri, '/'));

    if (empty($parts[0])) {
        return 'top';
    }

    return $parts[0];
  }
}
