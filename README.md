# CakeLocation plugin for CakePHP

version 2018.02.14.00

## インストール

下記のコンフィグに一行追加して読み込みます。
config/bootstrap.php
```
Plugin::load('CakePG/CakeLocation', ['bootstrap' => true, 'routes' => true]);
```

`composer.json`に下記のを追記
以下、例
```
"repositories": [
    {
        "type": "vcs",
        "no-api": true,
        "url":  "git@github.com:CakePG/CakeLocation.git"
    }
],
```

キャッシュをクリア
```
docker-compose run --rm php php composer.phar dumpautoload
```

### テーブルを作成
```
docker-compose run --rm php php bin/cake.php migrations migrate -p CakePG/CakeLocation
```

### 設定

`vendor/CakePG/CakeLocation/config/location.php`をコピーして`config`に置きます。
config/bootstrap.phpに以下一行追加して読み込みます。
```
Configure::load("news");
```

#### 文言を変更する場合
`vendor/CakePG/CakeLocation/src/Locale/ja_JP/cakelocation.po`の内容を以下のファイルに追加してください。
`src/Locale/ja_JP/cakelocation.po`（ない場合は作成）

## 更新履歴

2018.02.14.00 場所のリスト用に作成
