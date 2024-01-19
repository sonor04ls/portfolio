<?php
// PDOを使用してデータベースへの接続を試みる
try {
    // 新しいPDOインスタンスを作成し、MySQLデータベースに接続
    $db = new PDO('mysql:dbname=hair_web;host=localhost;charset=utf8', 'root', 'root');
} catch (PDOException $e) {
    // PDOExceptionが発生した場合のエラーメッセージを表示
    echo 'DB接続エラー： ' . $e->getMessage();
}
