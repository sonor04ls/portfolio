<?php
// セッションの開始、データベース接続ファイルと関数定義ファイルの読み込み
session_start();
require 'dbConnect.php';
require 'functions.php';

// ログイン処理
if ($_POST['login']) {
	// フォームから送信されたログインIDとパスワードを取得し、トリミングとサニタイズ
	$id = mbTrim(html($_POST['login_id']));
	$pw = mbTrim(html($_POST['login_pw']));
	unset($_SESSION['error']);
	unset($_SESSION['saved']);

	// 管理者情報をデータベースから取得
	$admin = $db->prepare('SELECT * FROM admin WHERE id = ?');
	$admin->bindParam(1, $id, PDO::PARAM_STR);
	$admin->execute();
	$admin = $admin->fetch();

	// ログインIDのチェック
	if (checkBlank($id) && checkLen($id, 4) && checkEnNum($id)) {
		// パスワードのチェック
		if (checkBlank($pw) && checkLen($pw, 4) && checkEnNum($pw)) {
			// IDとパスワードの認証
			if (!$admin || !password_verify($pw, $admin['password'])) {
				// 認証失敗のエラーメッセージ
				$_SESSION['error']['login'] = 'IDまたはパスワードが間違っています';
			} else {
				// 認証成功時の処理
				unset($_SESSION['error']);
			}
		} else {
			// パスワード形式エラーのメッセージ
			$_SESSION['error']['pw'] = '4文字以上の英数字を入力してください';
		}
	} else {
		// ID形式エラーのメッセージ
		$_SESSION['error']['id'] = '4文字以上の英数字を入力してください';
	}

	// エラーがある場合はログインページにリダイレクト
	if ($_SESSION['error']) {
		$_SESSION['saved']['id'] = $id;
		header('Location: adminLogin.php');
		exit();
	} else {
		// ログイン成功時のセッション設定とリダイレクト
		unset($_SESSION['saved']);
		$_SESSION['login']['result'] = 'OK';
		header('Location: adminReserve.php');
		exit();
	}
}
