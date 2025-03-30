## 概要

-   機密情報（パスワード等）を管理するシステムの API を管理。

## 作業ディレクトリ

-   `C:\xampp\htdocs\confidential-manager-api`

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

## xammp 設定

### Laravel プロジェクト配置場所

-   `C:\xampp\htdocs`

### C:\xampp\apache\conf\httpd.conf

-   DocumentRoot、Directory を以下のように変更することで http://localhost でアクセス可能。

```conf
DocumentRoot "C:/xampp/htdocs/confidential-manager-api/public"
<Directory "C:/xampp/htdocs/confidential-manager-api/public">
    AllowOverride All
    Require all granted
</Directory>
```

## アプリ起動

-   xammp の Apache と MySQL（MariaDB）を起動。
-   MySQL の Admin で phpMyAdmin（DB）を起動。
-   .env の DB 設定を定義。

```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=confidential_manager
DB_USERNAME=root
DB_PASSWORD=
```

-   マイグレーション実行。

```bash
php artisan migrate
```
