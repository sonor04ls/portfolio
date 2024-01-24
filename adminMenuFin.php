<?php
session_start();

// 必要なファイル読み込み
require './dbConnect.php';
require './functions.php';
require './adminMenuExe.php';

// ログインしているユーザー以外は戻す
if ($_SESSION['login']['result']) {
	$radio = 4; //ラジオボタン用
} else {
	header('Location: adminLogin.php');
}

// 変更 or 登録
if ($upd === true) {
	$h3 = 'メニュー変更';
	$p = '変更が完了しました';
} elseif ($ins === true) {
	$h3 = 'メニュー登録';
	$p = '登録が完了しました';
} elseif ($del === true) {
	$h3 = 'メニュー削除';
	$p = '削除が完了しました';
} else {
	$p = 'エラーが発生しました。もう一度お試しいただくか、管理システム会社までご連絡ください。';
}
?>


<!------------------------ 確認画面 ------------------------------------->
<?php require './adminHeader.php'; ?>


<div class="wrapper">
	<h2 class="admin-title">管理者メニュー</h2>
	<?php require './adminMenu.php' ?>
	<div class="admin-contents admin-page admin-edit-fin">
		<h3><?= $h3 ?></h3>
		<p><?= $p ?></p>
		<div class="btn-area">
			<a href="./adminMenuList.php" class="btn btn-cubic">戻る</a>
		</div>
	</div>
</div>
<?php require './footer.php'; // フッターファイルを読み込む  
?>