<?php
/* Smarty version 3.1.30, created on 2019-04-21 07:43:31
  from "C:\xampp\htdocs\master\Section77\php_libs\smarty\templates\testsmarty.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cbc03034a0931_85507057',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'de1a9ce22e21a5c0554c774df7bc835cdf35c42d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\master\\Section77\\php_libs\\smarty\\templates\\testsmarty.php',
      1 => 1555825200,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cbc03034a0931_85507057 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php
';?>define('_ROOT_DIR', __DIR__ . '/');
require_once _ROOT_DIR . '../php_libs/init.php';

$smarty  = new Smarty;
$smarty->template_dir = _SMARTY_TEMPLATES_DIR;
$smarty->compile_dir  = _SMARTY_TEMPLATES_C_DIR;
$smarty->config_dir   = _SMARTY_CONFIG_DIR;
$smarty->cache_dir    = _SMARTY_CACHE_DIR;
$smarty->assign("title", "タイトル名");

$file = 'testsmarty.tpl';

$smarty->display($file);

<?php }
}
