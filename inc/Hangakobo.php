<?php
require_once __DIR__ . '/ContentLoader.php';
require_once __DIR__ . '/ContentNavigation.php';
require_once __DIR__ . '/Parsedown.php';

class Hangakobo {
  protected ?string $slug = null;
  protected int $count;
  protected int $page;
  protected string $class;
  protected array $posts = [];
  protected array $artworks = [];
  public ?array $article = null;

  public function __construct() {
    $this->slug  = $_GET['slug'] ?? null;
    $this->count = (int)($_GET['count'] ?? 10);
    $this->page  = (int)($_GET['page'] ?? 1);
    $this->class = $this->get_class();

    // トップ階層と「木版画ギャラリー」以外では、classからメイン記事を取得する
    if ($this->class !== 'top' && $this->class !== 'gallery') {
      $dir    = dirname(__DIR__) . '/content/' . $this->class . '/';
      $loader = new ContentLoader($dir);
      $this->posts = $loader->load();
    }

    // 個別記事では、slugから個別記事を取得する
    if ($this->is_single()) {;
      $dir    = dirname(__DIR__) . '/content/' . $this->class . '/';
      $loader = new ContentLoader($dir);
      $this->article = $loader->find($this->slug);
    }
	}

  public function is_single() {
    return $this->slug ? true : false;
  } 

  // 記事を返す
  // デフォルトではメイン記事を10件返す
  // 引数を指定して、サブ記事を取得できる
  public function get_posts(string $class = null, int $page = null, int $count = null): array {
    $page  = $page  ?? $this->page;
    $count = $count ?? $this->count;
    $class = $class ?? $this->class;

    if (!$class) {
      return array_slice($this->posts, $count * ($page - 1), $count);
    } else {
      // $classを指定した場合
      $dir    = dirname(__DIR__) . '/content/' . $class . '/';
      $loader = new ContentLoader($dir);
      $posts  = $loader->load();
      return array_slice($posts, $count * ($page - 1), $count);
    }
  }

  public function get_artworks(): array {
    $dir  = dirname(__DIR__) . '/content/artworks.json';
    $json = file_get_contents($dir);
    
    $this->artworks = json_decode($json, true);
    $this->artworks = array_reverse($this->artworks);

    return $this->artworks;
  }

  public function get_breadcrumb(): string {
    if ($this->class === 'posts') $subdirLabel = '版画ゆうびん';
    if ($this->class === 'about') $subdirLabel = '制作に寄せて';
    if ($this->class === 'info') $subdirLabel = 'お知らせ';
    if ($this->class === 'gallery') $subdirLabel = '木版画ギャラリー';
    if ($this->class === 'studio') $subdirLabel = '版画教室';

    $subdirPath = '/' . $this->class . '/';

    $nav = new ContentNavigation([
      'subdirLabel' => $subdirLabel,
      'subdirPath'  => $subdirPath
    ]);

    return $nav->breadcrumb($this->article);
  }

  public function pagination(): string {
    $currentPage = $this->page;
    $totalPages  = ceil(count($this->posts) / $this->count);

    $nav = new ContentNavigation();

    return $nav->pagination($currentPage, $totalPages);
  }

  public function text($text) {
    $parsedown = new Parsedown();
    return $parsedown->text($text);
  }

  protected function get_class(): string {
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
