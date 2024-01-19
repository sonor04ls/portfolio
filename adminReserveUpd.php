<?php
// セッション開始、データベース接続ファイルと関数定義ファイルの読み込み
session_start();
require 'dbConnect.php';
require 'functions.php';

// 更新処理
if ($_POST['upd']) {
	// フォームから送信された現在の予約情報を取得
	$current_id = html($_POST['current_id']);
	$current_day = html($_POST['current_day']);
	$new_day = html($_POST['day']);
	$start = html($_POST['start']);
	$end = html($_POST['end']);

	// 予約日が変更されなかった場合の処理
	if ($current_day === $new_day) {
		try {
			// 予約時間の更新処理
			$reserve_upd = $db->prepare('UPDATE reserve SET start_time=?, end_time=? WHERE id=?');
			$reserve_upd->bindParam(1, $start, PDO::PARAM_STR);
			$reserve_upd->bindParam(2, $end, PDO::PARAM_STR);
			$reserve_upd->bindParam(3, $current_id, PDO::PARAM_INT);
			$reserve_upd->execute();

			// 予約詳細（メニュー）の削除と再登録
			$menu_del = $db->prepare('DELETE FROM reserve_detail WHERE reserve_id=?');
			$menu_del->bindParam(1, $current_id, PDO::PARAM_INT);
			$menu_del->execute();

			foreach ($_POST['menus'] as $menu) {
				$menu_upd = $db->prepare('INSERT INTO reserve_detail (reserve_id, menu_id) VALUES (?, ?)');
				$menu_upd->bindParam(1, $current_id, PDO::PARAM_INT);
				$menu_upd->bindParam(2, $menu, PDO::PARAM_INT);
				$menu_upd->execute();
			}
			header('Location: adminReserve.php');
			exit();
		} catch (PDOException $e) {
			// データベース接続エラーの場合
			echo 'DB接続エラー： ' . $e->getMessage();
		}
	} else {
		// 予約日が変更された場合の処理
		// 新しい予約IDの生成
		$count_id = $db->prepare('SELECT COUNT(*) AS cnt FROM reserve WHERE day=?');
		$count_id->bindParam(1, $new_day, PDO::PARAM_STR);
		$count_id->execute();
		$count = $count_id->fetch();
		$count = $count['cnt'] > 0 ? $count['cnt'] + 1 : 1;
		$new_id = str_replace('-', '', $new_day) . sprintf('%02d', $count);

		try {
			// 予約情報の更新
			$reserve_upd = $db->prepare('UPDATE reserve SET id=?, day=?, start_time=?, end_time=? WHERE id=?');
			$reserve_upd->bindParam(1, $new_id, PDO::PARAM_INT);
			$reserve_upd->bindParam(2, $new_day, PDO::PARAM_STR);
			$reserve_upd->bindParam(3, $start, PDO::PARAM_STR);
			$reserve_upd->bindParam(4, $end, PDO::PARAM_STR);
			$reserve_upd->bindParam(5, $current_id, PDO::PARAM_INT);
			$reserve_upd->execute();

			// 予約詳細（メニュー）の削除と再登録
			$menu_del = $db->prepare('DELETE FROM reserve_detail WHERE reserve_id=?');
			$menu_del->bindParam(1, $current_id, PDO::PARAM_INT);
			$menu_del->execute();

			foreach ($_POST['menus'] as $menu) {
				$menu_upd = $db->prepare('INSERT INTO reserve_detail (reserve_id, menu_id) VALUES (?, ?)');
				$menu_upd->bindParam(1, $new_id, PDO::PARAM_INT);
				$menu_upd->bindParam(2, $menu, PDO::PARAM_INT);
				$menu_upd->execute();
			}
			header('Location: adminReserve.php');
			exit();
		} catch (PDOException $e) {
			// データベース接続エラーの場合
			echo 'DB接続エラー： ' . $e->getMessage();
		}
	}
}
