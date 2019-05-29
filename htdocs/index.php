<?php
/*************************************************
 * 会員実行スクリプト
 *ログイン画面を表示するまでのデバック
 *ログイン処理をするときのデバック
 */

/*
 * _ROOT_DIR の定義は、init.php に移動。
 * index.php では、定数を使わずにinit.php をrequire_onceする。
 */
//define('_ROOT_DIR', __DIR__ . '/');
require_once __DIR__ . '/../php_libs/init.php';
$controller = new MemberController();
$controller->run();

exit;
