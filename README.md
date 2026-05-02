# study_laravel

[![LICENSE](https://img.shields.io/badge/license-MIT-green.svg)](./LICENSE)
![releases](https://img.shields.io/github/release/q23isline/study_laravel.svg?logo=github)
[![Open in Visual Studio Code](https://img.shields.io/static/v1?logo=visualstudiocode&label=&message=Open%20in%20Visual%20Studio%20Code&labelColor=555555&color=007acc&logoColor=007acc)](https://github.dev/q23isline/study_laravel)

[![PHP](https://img.shields.io/static/v1?logo=php&label=PHP&message=v8.5&labelColor=555555&color=777BB4&logoColor=777BB4)](https://www.php.net)
[![Laravel](https://img.shields.io/static/v1?logo=laravel&label=Laravel&message=v13.6.0&labelColor=555555&color=FF2D20&logoColor=FF2D20)](https://laravel.com/)
[![PostgreSQL](https://img.shields.io/static/v1?logo=postgresql&label=PostgreSQL&message=v18.3&labelColor=555555&color=4169E1&logoColor=4169E1)](https://www.postgresql.org/)
[![Node.js](https://img.shields.io/static/v1?logo=node.js&label=Node.js&message=v24.15.0&labelColor=555555&color=339933&logoColor=339933)](https://nodejs.org)
[![npm](https://img.shields.io/static/v1?logo=npm&label=npm&message=v11&labelColor=555555&color=CB3837&logoColor=CB3837)](https://www.npmjs.com/)

Laravel 勉強用リポジトリ

- [開発者ガイド](./docs/developer-guide.md)

## 前提

- インストール（ホスト上に）
  - [Windows Subsystem for Linux](https://learn.microsoft.com/ja-jp/windows/wsl/)
  - [Git](https://git-scm.com/)
  - [Visual Studio Code](https://code.visualstudio.com/)
- インストール（Windows Subsystem for Linux 上に）
  - [PHP](https://www.php.net/downloads.php?os=linux&osvariant=linux-ubuntu&version=default)

## はじめにやること

1. Windows Subsystem for Linux 上でプログラムダウンロード

    ```bash
    git clone https://github.com/q23isline/study_laravel.git
    ```

2. リポジトリのカレントディレクトリへ移動

    ```bash
    cd study_laravel
    ```

3. 開発準備

    ```bash
    cp .env.example .env
    cp .vscode/extensions.json.default .vscode/extensions.json
    cp .vscode/launch.json.default .vscode/launch.json
    cp .vscode/settings.json.default .vscode/settings.json
    ```

4. アプリ立ち上げ

    ```bash
    docker compose build
    sudo chmod -R ugo+rw logs
    docker compose up -d
    docker compose exec app php composer.phar install
    docker exec -it app php artisan migrate
    docker exec -it app npm install
    docker exec -it app npm run build
    sudo chmod -R ogu+rw .
    docker exec -it app php composer.phar run dev
    ```

## 日常的にやること

### システム起動

```bash
# DB、アプリコンテナ起動
docker compose up -d
# アプリ起動
docker exec -it app php composer.phar run dev
```

### システム終了

```bash
# アプリ起動ターミナルで Ctrl + c

docker compose down
```

## 動作確認

### URL

#### アプリ

<http://localhost:8000>

#### バックエンド

<http://localhost:8000/docs/api>

#### フロントエンド

<http://localhost:5173/>

## Permission Deniedエラーが出た時の解決方法

```bash
# プロジェクト全体のファイルすべてに読み込み、書き込み権限を与える
sudo chmod -R ugo+rw .
# インストールしたライブラリに実行権限を含めた全権限を与える
sudo chmod -R 777 vendor node_modules
```

## データベースへの接続

| 項目名     | 設定値    |
| ---------- | --------- |
| サーバー名 | 127.0.0.1 |
| ユーザー名 | postgres  |
| パスワード | Passw0rd  |

## ログ出力場所

| サービス   | ログ出力場所  |
| ---------- | ------------- |
| PostgreSQL | logs/postgres |
| npm        | logs/npm      |
| Laravel    | storage/logs  |

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
