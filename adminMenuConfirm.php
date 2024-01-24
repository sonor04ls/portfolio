<?php
// セッションの開始
session_start();
// 必要なファイルの読み込み
require 'dbConnect.php';
require 'functions.php';
require 'adminMenuCheck.php';

// ログインしているユーザー以外は戻す
if ($_SESSION['login']['result']) {
	$radio = 4; //ラジオボタン用
} else {
	header('Location: adminLogin.php');
}

// ヘッダー読み込み
require 'adminHeader.php';

// 変更 or 登録 or 削除
if ($_POST['upd']) {
	$h3 = 'メニュー変更';
	$name = 'upd';
	$btn = '更新';
	$p = 'この内容で更新してもよろしいですか？';
	$return_link = './adminMenuEdit.php';
} elseif ($_POST['ins']) {
	$h3 = 'メニュー登録';
	$name = 'ins';
	$btn = '登録';
	$p = 'この内容で登録してもよろしいですか？';
	$return_link = './adminMenuEdit.php';
} elseif ($_POST['del']) {
	// 削除するメニューの情報取得
	$id = html($_GET['id']);
	$del = $db->prepare('SELECT * FROM menus WHERE id=?');
	$del->bindParam(1, $id, PDO::PARAM_INT);
	$del->execute();
	$ary = $del->fetch();

	$id = $ary['id'];
	$menu = $ary['menu'];
	$price = $ary['price'];
	$minutes = $ary['minutes'];

	$h3 = 'メニュー削除';
	$name = 'del';
	$btn = '削除';
	$p = 'この内容を削除してもよろしいですか？';
	$return_link = './adminMenuList.php';
} else {
	$h3 = '';
	$name = '';
}
?>

<!------------------------ 確認画面 ------------------------------------->
<div class="wrapper">
	<h2 class="admin-title">管理者メニュー</h2>
	<?php require './adminMenu.php' ?>
	<div class="admin-contents admin-page admin-edit">
		<h3><?= $h3 ?></h3>
		<?php if ($check_result === true || $_POST['del']) : ?>

			<form action="./adminMenuFin.php" method="post">
				<p>
					メニュー：<?= $menu ?>
					<input type="hidden" name="menu" value="<?= $menu ?>">
				</p>
				<p>
					料金：￥<?= number_format($price) ?>
					<input type="hidden" name="price" value="<?= $price ?>">
				</p>
				<p>
					所要時間：<?= $minutes ?>分
					<input type="hidden" name="minutes" value="<?= $minutes ?>">
				</p>

				<input type="hidden" name="id" value="<?= $id ?>">

				<div class="btn-area">
					<a href="<?= $return_link ?>" class="btn btn-cubic">戻る</a>
					<input type="submit" name="<?= $name ?>" class="btn btn-cubic" value="<?= $btn ?>">
				</div>
			</form>

		<?php else : ?>
			<p>エラーが発生しました。もう一度お試しいただくか、管理システム会社までご連絡ください。</p>
		<?php endif; ?>
	</div>
</div>

<?php
// フッターの読み込み
require 'footer.php';
?>