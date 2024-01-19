<?php
// セッションを開始し、必要なファイルを読み込む
session_start();
require 'dbConnect.php';
require 'functions.php';

// セッションから更新するIDとパスワードを取得し、パスワードをハッシュ化
$id = html($_SESSION['upd']['id']);
$pw = password_hash(mbTrim(html($_SESSION['upd']['pw'])), PASSWORD_DEFAULT);

// データベース更新
$edit_upd = $db->prepare('UPDATE admin SET id=?,password=?');
$edit_upd->bindParam(1, $id, PDO::PARAM_STR);
$edit_upd->bindParam(2, $pw, PDO::PARAM_STR);
$edit_upd->execute();

// 更新情報をセッションから削除
unset($_SESSION['upd']);

// 処理完了後、別のページにリダイレクト
header('Location: adminEditFin.php');
exit();
