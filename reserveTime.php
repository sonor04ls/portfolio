<?php
// セッションの開始と必要なファイルの読み込み
session_start();
require './dbConnect.php'; // データベース接続
require './functions.php'; // 共通関数
require './header.php'; // ヘッダー

// 予約不可時間の算出
// 特定の日に対する既存の予約を取得
$reserve = $db->prepare('SELECT id, DATE_FORMAT(start_time, "%H:%i") AS start, DATE_FORMAT(end_time, "%H:%i") AS end FROM reserve WHERE day=? ORDER BY id');
$reserve->bindParam(1, $_SESSION['saved']['day'], PDO::PARAM_STR);
$reserve->execute();
$reserve = $reserve->fetchAll(PDO::FETCH_ASSOC);

// 予約時間の設定
$work_time = new DateTime('09:00'); // 予約開始時間
$work_end = new DateTime('17:30'); // 予約終了時間
$previousHour = $work_time->format('H'); // 時間切り替えの追跡用
?>


<div class="wrapper">
	<h2 class="reserve-title">予約可能時間</h2>
	<div class="reserve-contents">
		<form action="reserve.php" class="reserve1" method="post">
			<!-- 予約時間の選択表示 -->
			<p>予約時間を選択してください。</p><br>
			<?php
			// 営業時間内で予約可能な時間を確認し、表示する
			$i = 0;
			while ($work_time <= $work_end) {
				if ($i % 2 === 0) {
					echo '<div>';
				}
				$time = $work_time->format('H:i');
				$currentHour = $work_time->format('H');

				// 時間が切り替わるたびに改行を出力
				if ($currentHour !== $previousHour) {
					$previousHour = $currentHour;
				}

				$result = true; // 予約可能と仮定
				foreach ($reserve as $value) {
					$start = new DateTime($value['start']);
					$end = new DateTime($value['end']);
					if ($work_time >= $start && $work_time < $end) {
						// 既存の予約と重なる時間は予約不可
						$result = false;
						break;
					}
				}

				// 予約可能な時間にリンクを表示
				if ($result) {
					$bool = 'ok';
					$ok_ng = ' ◯';
					$link = './reserveConfirm.php?time=' . $time;
				} else {
					$bool = 'ng';
					$ok_ng = ' ×';
					$link = ''; // 予約不可の場合リンクなし
				}
				echo '<a href="' . $link . '" class="reserve-btn ' . $bool . '">' . $time . $ok_ng . '</a>';

				// 次の時間帯に進める
				$work_time->add(new DateInterval("PT30M"));
				if ($i % 2 !== 0) {
					echo '</div>';
				}
				$i++;
			}
			?>
			<div>
				<input type="submit" class="btn btn-cubic" value="戻る">
			</div>
		</form>
	</div>
</div>

<?php
require './footer.php'; //フッターの読み込み
?>