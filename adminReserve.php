<?php
// セッション開始、必要なファイルの読み込み
session_start();
// ログインしているユーザー以外は戻す
if ($_SESSION['login']['result']) {
	$radio = 1; //ラジオボタン用
} else {
	header('Location: adminLogin.php');
}
require 'dbConnect.php'; // データベース接続
require 'functions.php'; // 関数定義
require 'adminHeader.php'; // ヘッダー

// 予約情報を取得するSQLクエリ
$sql = 'SELECT id, name, day, tel, DATE_FORMAT(start_time, "%H:%i") AS start, DATE_FORMAT(end_time, "%H:%i") AS end FROM reserve ORDER BY id';
$reserve = $db->query($sql);
?>

<div class="wrapper">
	<h2 class="admin-title">管理者メニュー</h2>
	<?php require './adminMenu.php'; ?>
	<div class="admin-contents reserve-list">
		<h3>予約確認一覧</h3>
		<!-- 予約情報を表示するテーブル -->
		<table>
			<thead>
				<tr>
					<th>日付</th>
					<th>開始時間</th>
					<th>終了時間</th>
					<th>氏名</th>
					<th>電話番号</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($reserve as $value) : ?>
					<tr>
						<td><?= $value['day'] ?></td>
						<td><?= $value['start'] ?></td>
						<td><?= $value['end'] ?></td>
						<td><?= $value['name'] ?></td>
						<td><?= telPro($value['tel']) ?></td>
						<td><button type="button" onclick="location.href='adminReserveEdit.php?id=<?= $value['id'] ?>'" class="detail-button">詳細</button></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<?php
// フッターを読み込む
require 'footer.php';
?>