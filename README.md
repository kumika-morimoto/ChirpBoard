# ChirpBoard (小規模グループ向けミニSNS)

- X（旧Twitter）をイメージして学習目的で開発したミニSNSアプリｓです。
- 小規模グループ向けに、投稿・編集・削除・いいね機能を備えてます。
- Breeze 認証付きで、ログインしたユーザーのみが投稿を操作できます。
- Laravel + Tailwind CSS を使用して構築しました。

## 主な機能

- ユーザー登録 / ログイン / ログアウト
- 投稿の作成 / 編集 / 削除
- いいね（トグル）機能
- 自分の投稿一覧
- タイムライン表示
- ページネーション
- 認証ユーザーのみ操作可能

## 使用技術

- PHP 8.4.20
- Laravel 12.42.0
- MySQL 8.4.8
- Docker / Laravel Sail
- Tailwind CSS
- Laravel Breeze

## セットアップ

```bash
git clone https://github.com/kumika-morimoto/ChirpBoard.git
cd ChirpBoard

cp .env.example .env

composer install

./vendor/bin/sail up -d

./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
```