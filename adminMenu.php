<?php
if ($radio === 1) {
	$ckd1 = 'checked';
} elseif ($radio === 2) {
	$ckd2 = 'checked';
} elseif ($radio === 3) {
	$ckd3 = 'checked';
}
?>
<div class="admin-menu">
	<!-- 予約確認タブ -->
	<a href="adminReserve.php">
		<input type="radio" name="tab-1" <?= $ckd1 ?> />
		予約確認
	</a>
	<a href="adminEdit.php">
		<input type="radio" name="tab-1" <?= $ckd2 ?> />
		管理者情報変更
	</a>
	<a href="adminLogout.php">
		<input type="radio" name="tab-1" <?= $ckd3 ?> />
		ログアウト
	</a>
</div>