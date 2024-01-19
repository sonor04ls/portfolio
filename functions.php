<?php

// HTML無効化
function html($text)
{
	return htmlspecialchars($text);
}
// 半角&全角スペース削除
function mbTrim($pString)
{
	return preg_replace(
		'/\A[\p{Cc}\p{Cf}\p{Z}]++|[\p{Cc}\p{Cf}\p{Z}]++\z/u',
		'',
		$pString
	);
}

// チェック系---------------------------------
// 空文字チェック
function checkBlank($value)
{
	if ($value === '') {
		return false;
	} else {
		return true;
	}
}
// 文字数チェック
function checkLen($value, $len)
{
	if (mb_strlen($value) >= $len) {
		return true;
	} else {
		return false;
	}
}
// 数字チェック
function checkNum($value)
{
	if (preg_match('/^[0-9]+$/', $value)) {
		return true;
	} else {
		return false;
	}
}
// 英数字チェック
function checkEnNum($value)
{
	if (preg_match("/^[a-zA-Z0-9-_@]+$/", $value)) {
		return true;
	} else {
		return false;
	}
}
// 日付チェック
function checkDay($value)
{
	if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
		return true;
	} else {
		return false;
	}
}
function checkTel($value)
{
	if (preg_match('/^\d{4}-\d{3}-\d{3}$/', $value) ||
	preg_match('/^\d{3}-\d{4}-\d{4}$/', $value) ||
	preg_match('/^\d{11}$/', $value) ||
	preg_match('/^\d{10}$/', $value)) {
		return true;
	} else {
		return false;
	}
}

// form系---------------------------------------
// セレクトボックス
function selected($value1, $value2)
{
	$result = ($value1 === $value2) ? 'selected' : '';
	return $result;
}
// ラジオボタン
function checked($value1, $value2)
{
	$result = ($value1 === $value2) ? 'checked' : '';
	return $result;
}

// 電話番号加工
function telPro($value)
{
	$value = preg_replace("/[^0-9]/", "", $value);
	if (strlen($value) > 10) {
		$tel_code = substr($value, 0, 3) . "-" . substr($value, 3, 4) . "-" . substr($value, 7);
	} else {
		$tel_code = substr($value, 0, 4) . "-" . substr($value, 4, 3) . "-" . substr($value, 7);
	}
	return $tel_code;
}

// 確認用
function ck($array)
{
	echo '<hr>';
	foreach ($array as $value) {
		var_dump($value);
		echo '<hr>';
	}
}
function postCk($array)
{
	echo '<hr>';
	foreach ($array as $value) {
		var_dump($_POST[$value]);
		echo '<hr>';
	}
}
