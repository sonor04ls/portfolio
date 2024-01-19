<?php
// セッションを開始し、ヘッダーを読み込む
session_start();

// ログインしているユーザー以外は戻す
if ($_SESSION['login']['result']) {
	$radio = 2; //ラジオボタン用
} else {
	header('Location: adminLogin.php');
}

require 'adminHeader.php';
?>
<div class="wrapper">
	<h2 class="admin-title">管理者メニュー</h2>
	<?php require './adminMenu.php' ?>
	<div class="admin-contents admin-page admin-edit-fin">
		<h3>管理者情報変更</h3>
		<p>変更が完了しました</p>
	</div>
</div>


<?php
// フッターを読み込む
require 'footer.php';
?>