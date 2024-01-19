<?php
// セッションを開始し、ヘッダーを読み込む
session_start();

// ログインしているユーザー以外は戻す
if ($_SESSION['login']['result']) {
	$radio = 2; //ラジオボタン用
} else {
	header('Location: adminLogin.php');
}
// エラーが存在する場合、エラーメッセージを設定
if ($_SESSION['error']) {
	$error_id = '<p class="error">' . $_SESSION['error']['id'] . '</p>';
	$error_pw = '<p class="error">' . $_SESSION['error']['pw'] . '</p>';
}
require 'adminHeader.php';
?>

<div class="wrapper">
	<h2 class="admin-title">管理者メニュー</h2>
	<?php require './adminMenu.php' ?>
	<div class="admin-contents admin-page">
		<h3>管理者情報変更</h3>
		<!-- 管理者情報編集フォーム -->
		<form action="adminEditCheck.php" method="post">
			<p>変更後のログインIDを入力してください</p>
			<dl>
				<dt><label for="edit_id">ログインID</label></dt>
				<dd><input type="text" class="text-box" id="edit_id" name="edit_id" value="<?= $_SESSION['saved']['id'] ?>"></dd>
				<?= $error_id ?>
			</dl>
			<p>変更後のパスワードを入力してください</p>
			<dl>
				<dt><label for="edit_pw">ログインパスワード</label></dt>
				<dd><input type="password" class="text-box" id="edit_pw" name="edit_pw" value=""></dd>
			</dl>
			<dl>
				<dt><label for="edit_pw2">ログインパスワード（再度入力）</label></dt>
				<dd><input type="password" class="text-box" id="edit_pw2" name="edit_pw2" value=""></dd>
				<?= $error_pw ?>
				<?= $error_pw2 ?>
			</dl>
			<input type="submit" value="次へ" name="edit_upd" class="btn btn-cubic">
		</form>
	</div>
</div>



<?php
// フッターを読み込む
require 'footer.php';
