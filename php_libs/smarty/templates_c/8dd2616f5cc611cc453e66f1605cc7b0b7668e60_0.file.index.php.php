<?php
/* Smarty version 3.1.30, created on 2019-04-18 12:09:39
  from "C:\xampp\htdocs\master\Section77\htdocs\index.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cb84ce35ac647_54058650',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8dd2616f5cc611cc453e66f1605cc7b0b7668e60' => 
    array (
      0 => 'C:\\xampp\\htdocs\\master\\Section77\\htdocs\\index.php',
      1 => 1555582175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cb84ce35ac647_54058650 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php
';?>/*************************************************
 * 会員実行スクリプト
 *ログイン画面を表示するまでのデバック
 *ログイン処理をするときのデバック
 */

define('_ROOT_DIR', __DIR__ . '/');
require_once _ROOT_DIR . '../php_libs/init.php';
$controller = new MemberController();
$controller->run();

exit;
<?php }
}
