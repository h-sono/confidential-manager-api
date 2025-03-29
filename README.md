## 概要

-   機密情報（パスワード等）を管理するシステムの API を管理。

## 作業ディレクトリ

-   C:\Users\sonob\confidential-manager-api

## 起動

-   `php artisan serve`

## キャッシュクリア

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```

## パッケージ管理

-   インストール：`composer install`または、`composer install --ignore-platform-reqs`
-   アップデート：`composer update`

## APP_KEY の生成

-   `php artisan key:generate`
