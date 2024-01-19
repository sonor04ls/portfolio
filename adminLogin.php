<?php
// セッションの開始と関数、ヘッダーファイルの読み込み
session_start();

require 'functions.php'; // 共通関数
require 'adminHeader.php'; // ページヘッダー
?>
<div class="wrapper">
	<h2 class="admin-title">管理者メニュー</h2>
	<?php require './adminMenu.php' ?>
	<div class="admin-contents admin-page">
		<h3>ログイン</h3>
		<form action="adminLoginCheck.php" method="post">
			<!-- ログインID入力フィールド -->
			<dl>
				<dt><label for="login_id">ログインID</label></dt>
				<dd>
					<input type="text" class="text-box" id="login_id" name="login_id" value="<?= html($_SESSION['saved']['id']) ?>">
					<?php if (!empty($_SESSION['error']['id'])) : ?>
						<!-- ログインIDエラーメッセージ表示 -->
						<p class="error"><?= html($_SESSION['error']['id']) ?></p>
					<?php endif; ?>
				</dd>
			</dl>

			<!-- パスワード入力フィールド -->
			<dl>
				<dt><label for="login_pw">ログインパスワード</label></dt>
				<dd>
					<input type="password" class="text-box" id="login_pw" name="login_pw">
					<?php if (!empty($_SESSION['error']['pw'])) : ?>
						<!-- パスワードエラーメッセージ表示 -->
						<p class="error"><?= html($_SESSION['error']['pw']) ?></p>
					<?php endif; ?>
				</dd>
			</dl>

			<!-- ログイン全体のエラーメッセージ表示 -->
			<?php if (!empty($_SESSION['error']['login'])) : ?>
				<p class="error"><?= html($_SESSION['error']['login']) ?></p>
			<?php endif; ?>

			<!-- ログインボタン -->
			<input type="submit" value="ログイン" name="login" class="btn btn-cubic">
		</form>
	</div>
</div>
<?php
// ページフッターの読み込み
require 'footer.php';
?>