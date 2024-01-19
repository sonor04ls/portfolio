<?php
// セッションの開始と依存ファイルの読み込み
session_start();
require './dbConnect.php';
require './functions.php';
require './header.php';

// データベースからメニュー情報を取得
if ($_SESSION['saved']['menus']) {
	$menu_ary = $_SESSION['saved']['menus'];
}
$i = 0;
$menus = $db->query('SELECT * FROM menus');
?>

<div class="wrapper">
	<h2 class="reserve-title">予約</h2>
	<div class="reserve-contents">
		<form action="reserveCheck.php" class="reserve1" method="post">
			<!-- 予約情報入力フォーム -->
			<div>
				<dl>
					<dt>予約日</dt>
					<dd>
						<input type="text" class="text-box" id="calendar" name="day" autocomplete="off" value="<?= $_SESSION['saved']['day'] ?>">
						<?php if ($_SESSION['error']['day']) : ?>
							<?= '<span class="error">' . $_SESSION['error']['day'] . '</span>' ?>
						<?php endif; ?>
					</dd>
				</dl>
			</div>
			<div>
				<dl>
					<dt>お名前</dt>
					<dd>
						<input type="text" class="text-box" name="name" value="<?= $_SESSION['saved']['name'] ?>">
						<?php if ($_SESSION['error']['name']) : ?>
							<?= '<span class="error">' . $_SESSION['error']['name'] . '</span>' ?>
						<?php endif; ?>
					</dd>
				</dl>
			</div>
			<div>
				<dl>
					<dt>電話番号</dt>
					<dd>
						<input type="tel" class="text-box" name="tel" value="<?= $_SESSION['saved']['tel'] ?>">
						<?php if ($_SESSION['error']['tel']) : ?>
							<?= '<span class="error">' . $_SESSION['error']['tel'] . '</span>' ?>
						<?php endif; ?>
					</dd>
				</dl>
			</div>
			<div>
				<dl>
					<dt>メニュー</dt>
					<dd class="aaa">
						<fieldset class="checkbox">
							<!-- メニュー選択チェックボックス -->
							<?php foreach ($menus as $menu) :
								$checked = checked($menu['id'], $menu_ary[$i]);
								$i++; ?>
								<label>
									<input type="checkbox" name="menus[]" value="<?= $menu['id'] ?>" <?= $checked ?> />
									<?= $menu['menu'] . ' : ¥' . number_format($menu['price']) ?>
								</label>
								<br>
							<?php endforeach; ?>
							<?php if ($_SESSION['error']['menus']) : ?>
								<?= '<span class="error">' . $_SESSION['error']['menus'] . '</span>' ?>
							<?php endif; ?>
						</fieldset>
					</dd>
				</dl>
			</div>
			<!-- 予約確認ボタン -->
			<input type="submit" name="reserve" class="btn btn-cubic" value="次へ">
		</form>
	</div>
</div>
<!-- フッターの読み込み -->
<?php require './footer.php'; ?>