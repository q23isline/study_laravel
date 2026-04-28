# 開発者ガイド

## アプリ標準チェック単体実行

```bash
# コード静的解析実行
docker compose exec app ./vendor/bin/phpstan analyse --memory-limit=2G
```

## PHPパッケージをインストールする

インストール済のパッケージは `composer.json` 参照

パッケージ一覧

<https://packagist.org/>

```bash
docker compose exec app php composer.phar require ｛パッケージ名｝
# larastan を開発用にインストールする例
# docker compose exec app php composer.phar require --dev larastan/larastan

# インストールしたパッケージに実行権限を含めた全権限を与える
sudo chmod -R 777 vendor
```
