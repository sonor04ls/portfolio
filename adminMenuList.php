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
require 'adminHeader.php';
// 不要なセッション削除
unset($_SESSION['error']);
unset($_SESSION['saved']);

// メニュー取得
$menus = $db->query('SELECT * FROM menus');
?>

<div class="wrapper">
	<h2 class="admin-title">管理者メニュー</h2>
	<?php require './adminMenu.php' ?>
	<div class="admin-contents admin-page reserve-list">
		<h3>メニュー一覧</h3>
		<form action="" method="post">
			<table>
				<tr>
					<th>メニュー</th>
					<th>料金</th>
					<th>所要時間</th>
					<th></th>
					<th></th>
				</tr>
				<?php foreach ($menus as $value) : ?>
					<tr>
						<td><?= $value['menu'] ?></td>
						<td>￥<?= number_format($value['price']) ?></td>
						<td><?= $value['minutes'] ?>分</td>
						<td>
							<input type="submit" class="detail-button" name="upd" formaction="adminMenuEdit.php?id=<?= $value['id'] ?>" value="変更">
						</td>
						<td>
							<input type="submit" class="detail-button" name="del" formaction="adminMenuConfirm.php?id=<?= $value['id'] ?>" value="削除">
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			<input type="submit" class="btn btn-cubic" name="ins" formaction="adminMenuEdit.php" value="追加">
		</form>
	</div>
</div>


<?php
// フッターの読み込み
require 'footer.php';
?>