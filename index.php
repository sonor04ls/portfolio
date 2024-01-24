<?php
session_start();
// 不要なセッション削除
unset($_SESSION['error']);
unset($_SESSION['saved']);
require './dbConnect.php';
require './header.php';
$menus = $db->query('SELECT * FROM menus');
?>

<img src="./images/top.png" alt="TOP画像" class="top-image">

<div class="wrapper">
	<section id="about" class="about">
		<h2>About</h2>
		<p>Lumiéreは、広島の〇〇地区に位置する美容室です。「癒し」と「大人の女性のリラックス」をコンセプトに、忙しい日常から一歩離れた穏やかな時間を提供しています。Lumiéreという名前には、お客様一人一人の内面から溢れる光を引き出し、日々の疲れを癒す場所となることを願いを込めて名付けました。
		</p>
		<div class="about-container">
			<h3>- Lumiéreが大切にしていること -</h3>
			<div class="about-note">
				<h4>お客様の時間への配慮</h4>
				<p>お客様がゆったりとした気持ちでサロンを訪れることができるよう、快適な予約システムと計画的な施術スケジュールを心掛けています。</p>
			</div>
			<div class="about-note">
				<h4>パーソナライズされたカット</h4>
				<p>髪質と頭の形状に合わせたカット技術で、お客様の自然な魅力を最大限に引き出し、日常生活でのスタイリングも楽しめるヘアスタイルをご提案します。</p>
			</div>
			<div class="about-note">
				<h4>至福のシャンプータイム</h4>
				<p>私たちのシャンプーサービスは、ただ髪を洗うだけでなく、お客様に至福のリラクゼーションを提供する時間です。温もりのある手技で心身ともに癒します。</p>
			</div>
			<div class="about-note">
				<h4>共感を大切にしたカウンセリング</h4>
				<p>お客様のご要望に耳を傾け、理想を共に創り上げるカウンセリングを行っています。どんな小さなことでも、お客様の心に寄り添った提案をさせていただきます。</p>
				<p>大人の女性が心からリラックスし、自分だけの時間を楽しめるサロン、それがLumiéreです。自然光が優しく差し込む、静かで落ち着いた空間で、日常を忘れさせる特別な体験をお楽しみください。
				</p>
			</div>
		</div>
	</section>

	<section id="menu" class="menu">
		<h2>料金</h2>
		<p>当美容院では豊富なメニューを提供しており、<br class="sp-only">お客様の美しさを引き立てます。</p>
		<div class="menu-container">
			<div class="menu-title">
				<p class="menu-list-ttl">サービス</p>
				<p class="menu-list-price">価格</p>
			</div>
			<?php foreach ($menus as $menu) : ?>
				<div class="menu-list">
					<p class="menu-list-ttl"><?= $menu['menu']; ?></p>
					<p class="menu-list-price">¥<?= number_format($menu['price']); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<section id="reserve">
		<h2>予約</h2>
		<p>美容院のご予約はウェブサイトから簡単に行えます。<br class="sp-only">ご希望の日時を選択して予約してください。</p>
		<a href="reserve.php" class="btn btn-cubic">予約する</a>
	</section>

	<section id="access">
		<h2>アクセス</h2>
		<p>美容院へのアクセス情報は以下の通りです。<br class="sp-only">お気軽にお越しください。</p>
		<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3291.9447641498664!2d132.45651422616066!3d34.4027498491407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z5bqD5bO25Z-O!5e0!3m2!1sja!2sjp!4v1704641447097!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		<address>
			店名: Lumiére
			<br> 住所: 〒730-0011 広島県広島市中区基町２１−１

		</address>
	</section>

	<section id="contact">
		<h2>お問い合わせ</h2>
		<p>ご質問やご予約に関するお問い合わせは<br class="sp-only">以下のアドレスまでメールをして頂くか、<br class="sp-only">お電話でお気軽にお問い合わせください。</p>
		<address>
			電話: 012-345-6789
			<br> メール: info@example.com
		</address>
	</section>
</div>
<?php require './footer.php'; ?>