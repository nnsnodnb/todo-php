# todo-php
PHPでToDo管理ツールを作りました！

## Installation

1. 適当なディレクトリにclone

  ```bash
  $ git clone git@github.com:nnsnodnb/todo-php.git
  $ cd todo-php
  ```

1. MySQLにログインしデータベース及びテーブルを作成

  ```bash
  $ mysql -u <username> -p
  mysql> CREATE DATABASE todo_php;
  mysql> USE todo_php;
  mysql> source todo_php.sql;
  ```

1. 設定ファイルの作成

 - サンプルのコピー

  ```bash
  $ cp config.sample.php config.php
  ```
 - 自分のサーバ用に設定

  ```php
  $dsn = 'mysql:host=localhost;dbname=todo_php';
  $user = 'root';
  $password = 'password';

  // 場合によっては以下のリンクも変更
  define('SITE_URL' , 'http://localhost/todo-php') ;
  ```

1. サーバにアップロード

## Specification

 - タスク一覧表示
 - タスク変更・閲覧
 - タスク登録
 - タスク削除

## Bug

### Issue [#1](https://github.com/nnsnodnb/todo-php/issues/1)

[0a0cad3](https://github.com/nnsnodnb/todo-php/commit/0a0cad383eb0f9b5aed25cb3f7278b61349ef96e)にて修正

- 削除ボタンの横のチェックボックスの挙動がおかしい

### Issue [#2](https://github.com/nnsnodnb/todo-php/issues/2)

[0579cff](https://github.com/nnsnodnb/todo-php/commit/0579cffe3ff03b464fdbfae559305473ac799ccd)

- 完了ボタンを押した時に一番上のタスクが完了になるという事態が発生


## Author

__[nnsnodnb](https://github.com/nnsnodnb)__
