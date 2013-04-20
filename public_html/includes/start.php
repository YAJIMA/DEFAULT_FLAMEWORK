<?php
// 全てのエラー出力をオフにする
// error_reporting(0);
// 単純な実行時エラーを表示する
// error_reporting(E_ERROR | E_WARNING | E_PARSE);
// E_NOTICE を表示させるのもおすすめ（初期化されていない
// 変数、変数名のスペルミスなど…）
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
// E_NOTICE 以外の全てのエラーを表示する
// これは php.ini で設定されているデフォルト値
// error_reporting(E_ALL ^ E_NOTICE);
// 全ての PHP エラーを表示する (Changelog を参照ください)
error_reporting(E_ALL);
// 全ての PHP エラーを表示する
// error_reporting(-1);
// error_reporting(E_ALL);// と同じ
// ini_set('error_reporting', E_ALL);
if(!isset($_SESSION)){
	session_name('ApplicationName');
	session_start();
}
date_default_timezone_set('Asia/Tokyo');
$startNowTime = microtime(true);
ini_set('default_mimetype', 'text/html');
ini_set('default_charset', 'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_http_input('pass');
mb_http_output('UTF-8');

require 'config.php';
require 'functions.php';

// 初期設定ロード
require 'classes/config.php';
$config = new confEngine();
$config->load();

//$kakunin = kakunin();
if(isset($_POST)) FormEncode(&$_POST);

?>