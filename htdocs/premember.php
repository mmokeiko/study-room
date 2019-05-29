<?php
/*************************************************
 * 会員本登録用スクリプト
 * 
 */
/*
 * _ROOT_DIR の定義は、init.php に移動。
 * index.php では、定数を使わずにinit.php をrequire_onceする。
 */
//define('_ROOT_DIR', __DIR__ . '/');
require_once __DIR__ . '/../php_libs/init.php';
$controller = new PrememberController();
$controller->run();

exit;