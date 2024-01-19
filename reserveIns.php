<?php
// セッションの開始と必要なファイルの読み込み
session_start();
require './dbConnect.php'; // データベース接続
require './functions.php'; // 共通関数

// 予約確定処理
if ($_POST['confirm']) {
	// セッションから予約情報を取得
	$day = $_SESSION['saved']['day'];
	$name = $_SESSION['saved']['name'];
	$tel = str_replace('-', '', $_SESSION['saved']['tel']); // ハイフンを削除
	$start = $_SESSION['saved']['start'] = html($_POST['start']);
	$end = $_SESSION['saved']['end'] = html($_POST['end']);
	$menus = $_SESSION['saved']['menus'];
	$total_price = $_SESSION['saved']['total_price'] = html($_POST['total_price']);
	$total_time = html($_POST['total_time']);
	$_SESSION['saved']['total_hour'] = intdiv($total_time, 60);
	$_SESSION['saved']['total_minutes'] = $total_time % 60;

	// 予約IDの生成
	$count_id = $db->prepare('SELECT COUNT(*) AS cnt FROM reserve WHERE day=?');
	$count_id->bindParam(1, $day, PDO::PARAM_STR);
	$count_id->execute();
	$count = $count_id->fetch();
	$count = $count['cnt'] > 0 ? $count['cnt'] + 1 : 1;
	$rv_id = str_replace('-', '', $day) . sprintf('%02d', $count);
	$_SESSION['saved']['rv_id'] = $rv_id;

	// 予約テーブルへのデータ挿入
	$reserve = $db->prepare('INSERT INTO reserve VALUES(?,?,?,?,?,?)');
	$reserve->bindParam(1, $rv_id, PDO::PARAM_INT);
	$reserve->bindParam(2, $name, PDO::PARAM_STR);
	$reserve->bindParam(3, $day, PDO::PARAM_STR);
	$reserve->bindParam(4, $tel, PDO::PARAM_STR);
	$reserve->bindParam(5, $start, PDO::PARAM_STR);
	$reserve->bindParam(6, $end, PDO::PARAM_STR);
	$reserve->execute();

	// 予約メニューテーブルへのデータ挿入
	foreach ($menus as $menu_id) {
		$rv_menu = $db->prepare('INSERT INTO reserve_detail VALUES(?,?)');
		$rv_menu->bindParam(1, $rv_id, PDO::PARAM_INT);
		$rv_menu->bindParam(2, $menu_id, PDO::PARAM_INT);
		$rv_menu->execute();
	}

	// 予約完了ページへリダイレクト
	header('Location: reserveFin.php');
	exit();
}
