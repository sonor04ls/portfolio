<?php
// セッションの開始、データベース接続ファイルと関数定義ファイルの読み込み
session_start();
require './dbConnect.php';
require './functions.php';

// 予約処理
if ($_POST['reserve']) {
	// 既存のエラー情報と保存された入力情報をセッションから削除
	unset($_SESSION['error']);
	unset($_SESSION['saved']);

	// 入力情報の取得とサニタイズ
	$br = '<br>'; // 改行タグ
	$_SESSION['saved']['day'] = mbTrim(html($_POST['day']));
	$_SESSION['saved']['name'] = mbTrim(html($_POST['name']));
	$_SESSION['saved']['tel'] = mbTrim(html($_POST['tel']));
	$_SESSION['saved']['menus'] = $_POST['menus'];

	// 予約日のバリデーション
	if (checkBlank($_SESSION['saved']['day'])) { // 空のチェック
		if (checkDay($_SESSION['saved']['day'])) { // 日付のフォーマットチェック
			unset($_SESSION['error']['day']);
		} else {
			$_SESSION['error']['day'] = $br . '「2024-01-01」のように半角で入力してください';
		}
	} else {
		$_SESSION['error']['day'] = $br . '日付を選んでください';
	}

	// 名前のバリデーション
	if (checkBlank($_SESSION['saved']['name'])) { // 空のチェック
		if (!checkEnNum($_SESSION['saved']['name'])) { // 名前が英数字のみでないことのチェック
			unset($_SESSION['error']['name']);
		} else {
			$_SESSION['error']['name'] = $br . '日本語で入力してください';
		}
	} else {
		$_SESSION['error']['name'] = $br . '名前が未入力です';
	}

	// 電話番号のバリデーション
	if (checkBlank($_SESSION['saved']['tel'])) { // 空のチェック
		$_SESSION['saved']['tel'] = telPro($_SESSION['saved']['tel']); // 電話番号のフォーマット処理
		if (checkTel($_SESSION['saved']['tel'])) { // 電話番号のフォーマットチェック
			unset($_SESSION['error']['tel']);
		} else {
			$_SESSION['error']['tel'] = $br . '電話番号を入力してください';
		}
	} else {
		$_SESSION['error']['tel'] = $br . '電話番号が未入力です';
	}

	// メニュー選択のバリデーション
	if (count($_SESSION['saved']['menus']) >= 1) {
		unset($_SESSION['error']['menus']);
	} else {
		$_SESSION['error']['menus'] = $br . 'メニューを1件以上選択してください';
	}

	// バリデーション後の処理
	if ($_SESSION['error']) {
		// エラーがある場合、予約ページにリダイレクト
		header('Location: reserve.php');
		exit();
	} else {
		// エラーがない場合、予約時間選択ページにリダイレクト
		header('Location: reserveTime.php');
		exit();
	}
}
