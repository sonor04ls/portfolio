<?php
// セッションの開始
session_start();

// ログインしているユーザー以外は戻す
if ($_SESSION['login']['result']) {
	$radio = 4; //ラジオボタン用
} else {
	header('Location: adminLogin.php');
}
// 必要なファイルの読み込み
require 'dbConnect.php';
require 'functions.php';
require 'adminHeader.php';

// 表示
if ($_POST['upd']) {
	// 変更するメニューの情報取得
	$id = html($_GET['id']);
	$upd = $db->prepare('SELECT * FROM menus WHERE id=?');
	$upd->bindParam(1, $id, PDO::PARAM_INT);
	$upd->execute();
	$ary = $upd->fetch();

	$id = $ary['id'];
	$menu = $ary['menu'];
	$price = $ary['price'];
	$minutes = $ary['minutes'];

	$h3 = $_SESSION['saved']['h3'] = 'メニュー変更';
	$name = $_SESSION['saved']['name'] = 'upd';
} elseif ($_POST['ins']) {
	$id = '';
	$menu = '';
	$price = '';
	$minutes = '';

	$h3 = $_SESSION['saved']['h3'] = 'メニュー登録';
	$name = $_SESSION['saved']['name'] = 'ins';
} else {
	// 戻されたとき
	$id = $_SESSION['saved']['id'];
	$menu = $_SESSION['saved']['menu'];
	$price = $_SESSION['saved']['price'];
	$minutes = $_SESSION['saved']['minutes'];

	$h3 = $_SESSION['saved']['h3'];
	$name = $_SESSION['saved']['name'];
}

// エラー処理
$error_menu = $_SESSION['error']['menu'] ? '<span class="error">' . $_SESSION['error']['menu'] . '</span>' : '';
$error_price = $_SESSION['error']['price'] ? '<span class="error">' . $_SESSION['error']['price'] . '</span>' : '';
$error_minutes = $_SESSION['error']['minutes'] ? '<span class="error">' . $_SESSION['error']['minutes'] . '</span>' : '';
?>

<div class="wrapper">
	<h2 class="admin-title">管理者メニュー</h2>
	<?php require './adminMenu.php' ?>
	<div class="admin-contents admin-page reserve-edit">
		<h3><?= $h3 ?></h3>

		<form action="./adminMenuConfirm.php" method="post">

			<table>
				<tr>
					<th>メニュー：</th>
					<td>
						<input type="text" class="text-box" name="menu" value="<?= $menu ?>">
					</td>
					<td><?= $error_menu ?></td>
				</tr>
				<tr>
					<th>料金(円)：</th>
					<td>
						<input type="text" class="text-box" name="price" value="<?= $price ?>">
					</td>
					<td><?= $error_price ?></td>
				</tr>
				<tr>
					<th>所要時間(分)：</th>
					<td>
						<input type="text" class="text-box" name="minutes" value="<?= $minutes ?>">
					</td>
					<td><?= $error_minutes ?></td>
				</tr>
			</table>

			<input type="hidden" name="id" value="<?= $id ?>">

			<div class="btn-area">
				<a href="./adminMenuList.php" class="btn btn-cubic">戻る</a>
				<input type="submit" class="btn btn-cubic" name="<?= $name ?>" value="次へ">
			</div>
		</form>
	</div>
</div>


<?php
// フッターの読み込み
require 'footer.php';
?>