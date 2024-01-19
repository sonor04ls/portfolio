<?php
session_start();
// ログインしているユーザー以外は戻す
if ($_SESSION['login']['result']) {
	$radio = 1; //ラジオボタン用
} else {
	header('Location: adminLogin.php');
}
require 'dbConnect.php';
require 'functions.php';
require 'adminHeader.php';


// 予約情報
$id = html($_GET['id']);
$sql = 'SELECT id,name,day,tel,DATE_FORMAT(start_time, "%H:%i") AS start,DATE_FORMAT(end_time, "%H:%i") AS end FROM reserve WHERE id=? ORDER BY id';
$reserve = $db->prepare($sql);
$reserve->bindParam(1, $id, PDO::PARAM_INT);
$reserve->execute();
$reserve = $reserve->fetch();
// 予約メニュー
$menu_sql = 'SELECT menu_id FROM reserve_detail WHERE reserve_id=?';
$menus = $db->prepare($menu_sql);
$menus->bindParam(1, $id, PDO::PARAM_INT);
$menus->execute();
$menu_ary = $menus->fetchAll(PDO::FETCH_ASSOC);
$menu_ids = array_column($menu_ary, 'menu_id');
$menu_all = $db->query('SELECT * FROM menus');
?>



<div class="wrapper">
	<h2 class="admin-title">管理者メニュー</h2>
	<?php require './adminMenu.php' ?>
	<div class="admin-contents admin-page reserve-edit">
		<h3>予約確認詳細</h3>
		<form action="" method="post">

			<input type="hidden" name="current_id" value="<?= $id ?>">
			<input type="hidden" name="current_day" value="<?= $reserve['day'] ?>">

			<table>
				<tr>
					<th>日付&nbsp;:&nbsp;</th>
					<td>
						<input type="text" id="calendar" class="text-box" name="day" value="<?= $reserve['day'] ?>">
					</td>
				</tr>
				<tr>
					<th>開始時間&nbsp;:&nbsp;</th>
					<td>
						<input type="time" class="text-box" name="start" value="<?= $reserve['start'] ?>">
					</td>
				</tr>
				<tr>
					<th>終了時間&nbsp;:&nbsp;</th>
					<td>
						<input type="time" class="text-box" name="end" value="<?= $reserve['end'] ?>">
					</td>
				</tr>
				<tr>
					<th>氏名&nbsp;:&nbsp;</th>
					<td>
						<?= $reserve['name'] ?>
					</td>
				</tr>
				<tr>
					<th>電話番号&nbsp;:&nbsp;</th>
					<td>
						<?= telPro($reserve['tel']) ?>
					</td>
				</tr>
				<tr>
					<th>メニュー&nbsp;:&nbsp;</th>
					<td>
						<?php foreach ($menu_all as $menu) :
							$checked = in_array($menu['id'], $menu_ids) ? 'checked' : '';
							$total_price += $checked === 'checked' ? $menu['price'] : 0; ?>

							<fieldset class="checkbox">
								<label>
									<input type="checkbox" name="menus[]" value="<?= $menu['id'] ?>" <?= $checked ?> />
									<?= $menu['menu'] . ' : ¥' . number_format($menu['price']) ?>
								</label>
							</fieldset>

						<?php endforeach; ?>
					</td>
				</tr>
				<tr>
					<th>料金合計&nbsp;:&nbsp;</th>
					<td>¥<?= number_format($total_price) ?></td>
				</tr>
			</table>
			<div class="btn-area">
				<button type="submit" onclick="location.href='adminReserveUpd.php'" name="upd" value="send" class="btn btn-cubic">更新</button>
				<a href="adminReserveDel.php?id=<?= $id ?>" class="btn btn-cubic">削除</a>
				<button type="button" onclick="location.href='adminReserve.php'" class="btn btn-cubic">戻る</button>
			</div>
		</form>
	</div>
</div>

<?php require 'footer.php' ?>