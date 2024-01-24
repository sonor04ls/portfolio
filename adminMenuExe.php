<?php
unset($_SESSION['saved']);

$id = html(mbTrim($_POST['id']));
$menu = html(mbTrim($_POST['menu']));
$price = html(mbTrim($_POST['price']));
$minutes = html(mbTrim($_POST['minutes']));

$upd = false;
$ins = false;
$del = false;

// 変更処理----------------------------------------------------------
if ($_POST['upd']) {
	$upd = $db->prepare('UPDATE menus SET menu=?,price=?,minutes=? WHERE id=?');
	$upd->bindParam(1, $menu, PDO::PARAM_INT);
	$upd->bindParam(2, $price, PDO::PARAM_STR);
	$upd->bindParam(3, $minutes, PDO::PARAM_STR);
	$upd->bindParam(4, $id, PDO::PARAM_INT);
	$upd->execute();
	$upd = true;
}

// 登録処理----------------------------------------------------------
if ($_POST['ins']) {
	$ins = $db->prepare('INSERT INTO menus(menu,price,minutes) VALUES(?,?,?)');
	$ins->bindParam(1, $menu, PDO::PARAM_INT);
	$ins->bindParam(2, $price, PDO::PARAM_STR);
	$ins->bindParam(3, $minutes, PDO::PARAM_STR);
	$ins->execute();
	$ins = true;
}

// 削除処理----------------------------------------------------------
if ($_POST['del']) {
	$del = $db->prepare('DELETE FROM menus WHERE id=?');
	$del->bindParam(1, $id, PDO::PARAM_INT);
	$del->execute();
	$del = true;
}
