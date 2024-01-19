<?php
// セッションの開始と必要なファイルの読み込み
session_start();
require './dbConnect.php'; // データベース接続
require './functions.php'; // 共通関数
require './header.php'; // ヘッダー

// 選択されたメニューIDの取得とプレースホルダの生成
$menu_ids = $_SESSION['saved']['menus'];
$placeholders = implode(',', array_fill(0, count($menu_ids), '?'));
$sql = "SELECT * FROM menus WHERE id IN ($placeholders)";
$menus = $db->prepare($sql);

// 各メニューIDにバインド
foreach ($menu_ids as $key => $menu_id) {
	$menus->bindValue($key + 1, $menu_id, PDO::PARAM_INT);
}
$menus->execute();
$menusFetched = $menus->fetchAll();

// 総額と所要時間の計算
$total_price = 0;
$total_time = 0;
foreach ($menusFetched as $value) {
	$total_price += $value['price'];
	$total_time += $value['minutes'];
}
$hour = intdiv($total_time, 60);
$minutes = $total_time % 60;

// 予約開始時間の処理
$start = html($_GET['time']);
$date_time = DateTime::createFromFormat('H:i', $start);
$date_time->add(new DateInterval("PT" . $total_time . "M"));
$end = $date_time->format('H:i');
?>

<div class="wrapper">
	<h2 class="reserve-title">予約内容確認</h2>
	<div class="reserve-contents">

		<form action="" class="reserve1" method="post">
			<p>内容をご確認いただき、問題なければ確定してください。</p>
			<dl>
				<dt>予約日</dt>
				<dd>
					<?= $_SESSION['saved']['day'] ?>
				</dd>
			</dl>
			<dl>
				<dt>予約時間</dt>
				<dd>
					<?= $start ?>
					<input type="hidden" name="start" value="<?= $start ?>">
				</dd>
			</dl>
			<dl>
				<dt>終了予定時間</dt>
				<dd>
					<?= $end ?>
					<input type="hidden" name="end" value="<?= $end ?>">
				</dd>
			</dl>
			<dl>
				<dt>お名前</dt>
				<dd>
					<?= $_SESSION['saved']['name'] ?>
				</dd>
			</dl>
			<dl>
				<dt>電話番号</dt>
				<dd>
					<?= $_SESSION['saved']['tel'] ?>
				</dd>
			</dl>
			<dl>
				<dt>メニュー</dt>
				<dd>
					<?php foreach ($menusFetched as $value) : ?>
						<?= $value['menu'] . ':' . number_format($value['price']) . '円' ?>
						<br>
					<?php endforeach; ?>
				</dd>
			</dl>

			<div>
				<p>総額：<?= number_format($total_price) ?>円</p>
				<p>所要時間：<?= $hour . '時間' . $minutes . '分' ?></p>
			</div>
			
			<div>
				<input type="submit" name="confirm" class="btn btn-cubic" formaction="reserveIns.php" value="確定">
				<input type="submit" class="btn btn-cubic" formaction="reserve.php" value="戻る">
			</div>

			<input type="hidden" name="total_price" value="<?= $total_price ?>">
			<input type="hidden" name="total_time" value="<?= $total_time ?>">
			
		</form>
	</div>
</div>
<?php require './footer.php'; ?>