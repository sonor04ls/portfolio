<?php
// セッションを開始
session_start();
require 'dbConnect.php';
require 'functions.php';

// 管理者情報の編集確認（'edit'）または更新（'edit_upd'）の処理
if ($_POST['edit'] || $_POST['edit_upd']) {
	// 以前のエラー情報と保存データをセッションから削除
	unset($_SESSION['error']);
	unset($_SESSION['saved']);

	// 入力データのトリミングとサニタイズ
	$id = $_SESSION['saved']['id'] = mbTrim(html($_POST['edit_id']));
	$pw = mbTrim(html($_POST['edit_pw']));

	// IDの入力チェック
	if (checkBlank($id) && checkLen($id, 4) && checkEnNum($id)) {
		unset($_SESSION['error']['id']);
	} else {
		$_SESSION['error']['id'] = '4文字以上の英数字で入力してください';
	}

	// パスワードの入力チェック
	if (checkBlank($pw) && checkLen($pw, 4) && checkEnNum($pw)) {
		unset($_SESSION['error']['pw']);
		// ID＆パスワード更新の場合の追加のチェック
		if ($_POST['edit_upd']) {
			$pw1 = html($_POST['edit_pw']);
			$pw2 = html($_POST['edit_pw2']);
			if ($pw1 === $pw2) {
				unset($_SESSION['error']['pw']);
			} else {
				$_SESSION['error']['pw'] = 'パスワードがどちらか間違っています。';
			}
		}
	} else {
		$_SESSION['error']['pw'] = '4文字以上の英数字で入力してください';
	}

	// ログインIDとパスワードの確認処理
	if ($_POST['edit'] && !$_SESSION['error']['id'] && !$_SESSION['error']['pw']) {
		$admin = $db->prepare('SELECT * FROM admin WHERE id = ?');
		$admin->bindParam(1, $id, PDO::PARAM_STR);
		$admin->execute();
		$admin = $admin->fetch();
		if (!$admin || !password_verify($pw, $admin['password'])) {
			$_SESSION['error']['login'] = 'IDまたはパスワードが間違っています';
		}
	}

	// エラーの有無に基づくリダイレクト処理
	if ($_SESSION['error']) {
		// エラーがある場合のリダイレクト
		if ($_POST['edit']) {
			header('Location: adminEdit.php');
			exit();
		} elseif ($_POST['edit_upd']) {
			header('Location: adminEditUpdIn.php');
			exit();
		}
	} else {
		// エラーがない場合のリダイレクト
		unset($_SESSION['saved']);
		if ($_POST['edit']) {
			header('Location: adminEditUpdIn.php');
			exit();
		} elseif ($_POST['edit_upd']) {
			// 更新情報をセッションに保存
			$_SESSION['upd']['id'] = $id;
			$_SESSION['upd']['pw'] = $pw;
			header('Location: adminEditUpdOut.php');
			exit();
		}
	}
}
