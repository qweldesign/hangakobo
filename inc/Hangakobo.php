<?php
require_once __DIR__ . '/ContentLoader.php';
require_once __DIR__ . '/Parsedown.php';

class Hangakobo {
  public function __construct() {
    $slug  = $_GET['slug'] ?? null;
    $count = (int)($_GET['count'] ?? 10);
    $page  = (int)($_GET['page'] ?? 1);

    $class = $this->get_page();

    // トップ階層では、最新3件の記事を取得する
    if ($class === 'top') {
      $count = 3;
      $page  = 1;
    }

    // 個別記事では、最新4件の記事を取得する
    if ($slug) {
      $count = 4;
      $page  = 1;
    }

    // トップ階層、「版画ゆうびん」、「お知らせ」では、posts と info から記事を取得
    if ($class === 'top' || $class === 'posts' || $class == 'info') {
      $postsDir    = dirname(__DIR__) . '/content/posts/';
      $infoDir     = dirname(__DIR__) . '/content/info/';
      $postsLoader = new ContentLoader($postsDir);
      $infoLoader  = new ContentLoader($infoDir);
      // posts記事取得
      $this->posts = $postsLoader->load();
      $this->posts = array_slice($this->posts, $count * ($page - 1), $count);
      // info記事取得
      $this->info = $infoLoader->load();
      $this->info = array_slice($this->info, $count * ($page - 1), $count);
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

    // トップ階層では、artworks.jsonも読み込む
    if ($class === 'top') {
      $jsonDir = dirname(__DIR__) . '/content/artworks.json';
      $json    = file_get_contents($jsonDir);
      // artworks.json
      $this->artworks = json_decode($json, true);
      $this->artworks = array_reverse($this->artworks);
    }

    // $slugがあれば、個別記事を読み込む
    if ($slug && $class === 'posts') {
      $this->article = $postsLoader->find($slug);
    }
    if ($slug && $class === 'info') {
      $this->article = $infoLoader->find($slug);
    }
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
