# 版画ゆうびん舎

版画ゆうびん舎 - 越前海岸から発信 おさのなおこの版画工房  
[https://hangakobo.com](https://hangakobo.com)  

※ このリポジトリは、[QWEL Markdown Engine (Simple CMS)](https://github.com/qweldesign/qwel-tools-md-engine) を使用して制作しています。  

---

## 構成 | Structure

```
config.php            サイトの設定 (サイト名, ナビ, 投稿タイプ, お問い合わせフォームなど)
index.php             トップページ (各セクションとお問い合わせフォームの入力画面)
posts/                版画ゆうびん (/posts/, /posts/xxx/)
info/                 お知らせ (/info/, /info/xxx/)
page/                 固定ページ (/page/about/, /page/studio/)
gallery/              木版画ギャラリー (/gallery/)
contact/              お問い合わせフォームの確認・完了画面 (/contact/confirm/, /contact/thanks/)
api/                  記事の API (posts.php), お問い合わせフォームの送信 (send.php)
inc/                  エンジン・テンプレート, Composer (PHPMailer), .env
```

### content

```
content/
  posts/*.md          版画ゆうびん (title, slug, img, date, summary)
  info/*.md           お知らせ (title, slug, img, date, summary)
  page/about.md       制作に寄せて (title, slug: "about", summary, sections: "about")
  page/studio.md      版画教室 (title, slug: "studio", summary, sections: "studio")
  about/*.md          制作に寄せての段落 (title, img, class, date)
  studio/*.md         版画教室の段落 (title, img, class, date)
  links/*.md          リンク集 (title, link, img, bg, color, summary, date)
  artworks.json       作品の一覧 (name, title, showOnFront, showOnGallery)
  artworks/           作品の画像 ({name}s.png)
  ogp/                OGP 画像
```

固定ページの `sections` に書いたディレクトリの Markdown が、画像付きの段落として日付の新しい順に並びます。  
content/ の中で公開されるのは画像と artworks.json だけです (Markdown は直接開けません)。

### お問い合わせフォーム

`/contact/` (入力) → `/contact/confirm/` (確認) → `/contact/thanks/` (完了) の3画面。入力内容は sessionStorage で確認画面へ渡し, 確認画面から `api/send.php` へ送信する。

1. `inc/` で `composer install` を実行し、PHPMailer を導入する
2. `inc/.env.example` を `inc/.env` としてコピーし、宛先・SMTP の設定を書き換える
3. `config.php` の `SITE_CONTACT` (タイトル, 説明文, 自動返信の署名など) と `SITE_CONTACT_FIELDS` (項目) を書き換える
4. `inc/` (`inc/vendor/` を含む) ごとサーバーにアップロードする

秘密の設定 (宛先・SMTP) は `inc/.env` に書く (各項目の説明は `inc/.env.example` を参照)。`.env` には SMTP のパスワードが含まれるため Git には含めない。`inc/.htaccess` で `inc/` ごと Web から読めないようにしているが、可能であれば公開ディレクトリの外に置き、`config.php` の `SITE_CONTACT` の `env` を書き換えるとより安全。

設定に不備があると `api/send.php` は 500 を返し、内容をサーバーのエラーログに残す。

- 項目は `SITE_CONTACT_FIELDS` から, 入力欄・確認画面・メール本文・サーバー側の検証をまとめて作る (`text`, `email`, `tel`, `url`, `textarea`, `select`, `radio`, `checkbox`)
- 最初の `email` 項目を, 自動返信の宛先と管理者宛メールの返信先にする
- 迷惑メール対策: Origin / Referer のチェック, 見えない入力欄 (ハニーポット), 同じセッションからの送信間隔の制限 (`SITE_CONTACT` の `interval` 秒)
- 自動返信だけ失敗した場合は, ログに残して送信成功として扱う
- メールの送信には [PHPMailer](https://github.com/PHPMailer/PHPMailer) を Composer で導入して使う (更新は `composer update`)。`inc/vendor/` は Git に含めず, `inc/.htaccess` で Web から読めないようにしている
- `inc/vendor/` がない場合も入力画面などは表示でき, 送信時に 500 を返して理由をエラーログに残す

### API

- 一覧: `api/posts.php?type=blog&page=1&count=10` → `{ type, page, totalPages, total, posts: [{ title, slug, date, summary, img, url }] }`
- 個別記事: `api/posts.php?type=blog&slug=xxx` → `{ title, slug, date, summary, img, url, content }`

---

## ライセンス | License

### コード部分 | Code

MIT License

詳しくは LICENSE ファイルをご覧ください。  
See the LICENSE file for details.

### 版画作品 | Artworks

All copyright of the artworks belongs to Naoko Osano.  
Secondary use or reproduction is not permitted without explicit permission.  

版画作品の著作権は全て、おさのなおこに帰属します。  
二次利用・転載は、明示的な許可なしには認められていません。  

---

## 制作者 | Author

[QWEL.DESIGN](https://qwel.design)  
福井を拠点に活動するフロントエンド開発者  
Front-end developer based in Fukui, Japan  
