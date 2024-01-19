<?php
// セッションの開始
session_start();

// ログインしているユーザー以外は戻す
if ($_SESSION['login']['result']) {
	$radio = 2; //ラジオボタン用
} else {
	header('Location: adminLogin.php');
}
// ヘッダーの読み込み
require 'adminHeader.php';
// エラーが存在する場合、エラーメッセージを設定
if ($_SESSION['error']) {
	$error_id = '<p class="error">' . $_SESSION['error']['id'] . '</p>';
	$error_pw = '<p class="error">' . $_SESSION['error']['pw'] . '</p>';
	$error_login = '<p class="error">' . $_SESSION['error']['login'] . '</p>';
}
?>

<div class="wrapper">
	<h2 class="admin-title">管理者メニュー</h2>
	<?php require './adminMenu.php' ?>
	<div class="admin-contents admin-page admin-edit">
		<h3>管理者情報変更</h3>

		<!-- 管理者情報編集フォーム -->
		<form action="adminEditCheck.php" method="post">
			<p>現在のログインIDとパスワードを入力してください</p>
			<dl>
				<dt><label for="edit_id">ログインID</label></dt>
				<dd><input type="text" class="text-box" id="edit_id" name="edit_id" value="<?= $_SESSION['saved']['id'] ?>"></dd>
				<?= $error_id ?>
			</dl>
			<dl>
				<dt><label for="edit_pw">ログインパスワード</label></dt>
				<dd><input type="password" class="text-box" id="edit_pw" name="edit_pw" value=""></dd>
				<?= $error_pw ?>
			</dl>
			<?= $error_login ?>
			<input type="submit" value="次へ" name="edit" class="btn btn-cubic">
		</form>
	</div>
</div>


<?php
// フッターの読み込み
require 'footer.php';
?>