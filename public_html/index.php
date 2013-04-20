<?php
// スタートスクリプト
require './includes/start.php';
// 必要モジュールを読み込み

// SMARTY
require './includes/classes/smarty.php';
$smarty = new smartyEngine();
$assets = array();

if(!empty($_GET['info']) && $_GET['info'] == "phpinfo"){
	phpinfo();
	exit();
}

$template = 'index.html';
// エラー処理
$err = array();






// エラーをアサイン
$errors = (count($err) > 0) ? '<p class="errors">'.errors($err,'%s<br>').'</p>' : '';
$assets['errors'] = $errors;

// SMARTY出力
$smarty->assign($assets);
$smarty->display($template);

// エンドスクリプト
require './includes/end.php';
?>