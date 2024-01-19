<?php
// セッションの開始、必要なファイルの読み込み
session_start();

// ログインしているユーザー以外は戻す
if ($_SESSION['login']['result']) {
	$radio = 1; //ラジオボタン用
} else {
	header('Location: adminLogin.php');
}

require 'dbConnect.php'; // データベース接続
require 'functions.php'; // 関数定義
require 'adminHeader.php';
?>

<div class="wrapper">
	<h2 class="admin-title">管理者メニュー</h2>
	<?php require './adminMenu.php' ?>
	<div class="admin-contents admin-page">
		<h3>予約確認削除</h3>

		<?php
		// 予約削除処理
		$id = html($_GET['id']);
		if ($_POST['del']) :
			$del_id = html($_POST['id']);
			$del_reserve = $db->prepare('DELETE FROM reserve WHERE id=?');
			$del_reserve->bindParam(1, $del_id, PDO::PARAM_INT);
			$del_reserve->execute();
			$del_detail = $db->prepare('DELETE FROM reserve_detail WHERE id=?');
			$del_detail->bindParam(1, $del_id, PDO::PARAM_INT);
			$del_detail->execute();
		?>

			<p>削除削除に成功しました</p>
			<a href="./adminReserve.php">戻る</a>
		<?php else : ?>
			<form action="" method="post">
				<p>削除してもよろしいですか？</p>

				<input type="hidden" name="id" value="<?= $id ?>">
				<div class="btn-area">
					<input type="submit" name="del" class="btn btn-cubic" value="削除">
					<a href="./adminReserveEdit.php?id=<?= $id ?>" class="btn btn-cubic">戻る</a>
				</div>
			</form>
		<?php endif; ?>
	</div>
</div>
<?php require 'footer.php'; ?>