<?php
// チェック----------------------------------------------------------
if ($_POST['upd'] || $_POST['ins']) {
	$check_result = false;
	unset($_SESSION['error']);

	$id = $_SESSION['saved']['id'] = html(mbTrim($_POST['id']));
	$menu = $_SESSION['saved']['menu'] = html(mbTrim($_POST['menu']));
	$price = $_SESSION['saved']['price'] = html(mbTrim($_POST['price']));
	$minutes = $_SESSION['saved']['minutes'] = html(mbTrim($_POST['minutes']));

	// 名称チェック
	if (checkBlank(($menu))) {
			unset($_SESSION['error']['menu']);
	} else {
		$_SESSION['error']['menu'] = '未入力です';
	}
	
	// 金額チェック
	if (checkBlank(($price))) {
		if (checkNum($price)) {
			unset($_SESSION['error']['price']);
		} else {
			$_SESSION['error']['price'] = '数値のみ入力してください';
		}
	} else {
		$_SESSION['error']['price'] = '未入力です';
	}
	
	// 時間チェック
	if (checkBlank(($minutes))) {
		if (checkNum($minutes)) {
			unset($_SESSION['error']['minutes']);
		} else {
			$_SESSION['error']['minutes'] = '数値のみ入力してください';
		}
	} else {
		$_SESSION['error']['minutes'] = '未入力です';
	}

	// チェック後の処理
	if ($_SESSION['error']) {
		// エラーがあったら戻す
		header('Location: adminMenuEdit.php');
		exit();
	} else {
		// エラー無ければ確認画面表示
		$check_result = true;
		unset($_SESSION['error']);
	}
}
