</main>
<footer>
	<p id="page-top" class="pagetop"><a href="#header">page-top</a></p>
	<p>&copy; 2024 Lumiére. All Rights Reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
	// カレンダー
	$(function() {
		$('#calendar').datepicker({
			minDate: "+1d",
			maxDate: "+30d",
			dateFormat: 'yy-mm-dd',
			beforeShowDay: function(date) {
                const day = date.getDay();
                return [(day != 0), '']; // 日曜日以外は選択可能
			}
		});
	});

	//レスポンシブグローバルナビゲーション
	$(".menu-btn").click(function() { //ボタンがクリックされたら
		$(this).toggleClass('active'); //ボタン自身に activeクラスを付与し
		$(".gnaviSP").toggleClass('panelactive'); //ナビゲーションにpanelactiveクラスを付与
	});

	$("gnaviSP a").click(function() { //ナビゲーションのリンクがクリックされたら
		$(".openbtn").removeClass('active'); //ボタンの activeクラスを除去し
		$("gnaviSP").removeClass('panelactive'); //ナビゲーションのpanelactiveクラスも除去
	});

	//ページトップリンク
	function PageTopAnime() {
		var scroll = $(window).scrollTop();
		if (scroll >= 200) { //上から200pxスクロールしたら
			$('#page-top').removeClass('DownMove'); //#page-topについているDownMoveというクラス名を除く
			$('#page-top').addClass('UpMove'); //#page-topについているUpMoveというクラス名を付与
		} else {
			if ($('#page-top').hasClass('UpMove')) { //すでに#page-topにUpMoveというクラス名がついていたら
				$('#page-top').removeClass('UpMove'); //UpMoveというクラス名を除き
				$('#page-top').addClass('DownMove'); //DownMoveというクラス名を#page-topに付与
			}
		}
	}

	// 画面をスクロールをしたら動かしたい場合の記述
	$(window).scroll(function() {
		PageTopAnime(); /* スクロールした際の動きの関数を呼ぶ*/
	});

	// ページが読み込まれたらすぐに動かしたい場合の記述
	$(window).on('load', function() {
		PageTopAnime(); /* スクロールした際の動きの関数を呼ぶ*/
	});

	// #page-topをクリックした際の設定
	$('#page-top a').click(function() {
		$('body,html').animate({
			scrollTop: 0 //ページトップまでスクロール
		}, 500); //ページトップスクロールの速さ。数字が大きいほど遅くなる
		return false; //リンク自体の無効化
	});
</script>
</body>

</html>