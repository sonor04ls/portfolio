<?php
// セッションの開始と必要なファイルの読み込み
session_start();
require './dbConnect.php'; // データベース接続
require './functions.php'; // 共通関数
require './header.php'; // ヘッダー
?>

<div class="wrapper">
	<h2 class="reserve-title">予約確定</h2>
	<div class="reserve-contents">

		<form action="" class="reserve1" method="post">
			<div>
				<p>ご予約が完了しました。</p>
				<p>確認のお電話をさせて頂く場合があります。</p>
			</div>
			<dl>
				<dt>予約番号</dt>
				<dd><?= $_SESSION['saved']['rv_id'] ?></dd>
			</dl>
			<dl>
				<dt>予約日</dt>
				<dd>
					<?= $_SESSION['saved']['day'] ?>
				</dd>
			</dl>
			<dl>
				<dt>予約時間</dt>
				<dd>
					<?= $_SESSION['saved']['start'] ?>
				</dd>
			</dl>
			<dl>
				<dt>終了予定時間</dt>
				<dd>
					<?= $_SESSION['saved']['end'] ?>
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
					<?php
					foreach ($_SESSION['saved']['menus'] as $menu) :
						// 各メニューの詳細をデータベースから取得
						$menus = $db->prepare('SELECT * FROM menus WHERE id=?');
						$menus->bindParam(1, $menu, PDO::PARAM_INT);
						$menus->execute();
						$menu = $menus->fetch();
						$total += $menu['price']; // 合計金額の更新
					?>
						<?= $menu['menu'] . ':' . $menu['price'] . '円' ?>
						<br>
					<?php endforeach; ?>
				</dd>
			</dl>
			<div>
				<p>総額：<?= $_SESSION['saved']['total_price'] ?>円</p>
				<p>所要時間：<?= $_SESSION['saved']['total_hour'] . '時間' . $_SESSION['saved']['total_minutes'] . '分' ?></p>
			</div>
			<div>
				<input type="submit" class="btn btn-cubic" formaction="index.php" value="TOP">
			</div>
		</form>
	</div>
</div>

<?php
// 予約情報をセッションから削除
unset($_SESSION['saved']);
// フッターの読み込み
require './footer.php';
?>