<?php
session_start();
// ログインしているユーザー以外は戻す
if ($_SESSION['login']['result']) {
	$radio = 3; //ラジオボタン用
} else {
	header('Location: adminLogin.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
	// ログアウト後の処理
	unset($_SESSION['login']);
	header('Location: adminLogin.php');
	exit();
}
require 'adminHeader.php';
?>

<div class="wrapper">
	<h2 class="admin-title">管理者メニュー</h2>
	<?php require './adminMenu.php' ?>
	<div class="admin-contents admin-page">
		<h3>ログアウト</h3>
		<form action="" method="post">
			<p>ログアウトしますか？</p>
			<div class="btn-area">
				<button type="submit" name="logout" value="send" class="btn btn-cubic">ログアウト</button>
			</div>
		</form>
	</div>
</div>

<?php require 'footer.php' ?>