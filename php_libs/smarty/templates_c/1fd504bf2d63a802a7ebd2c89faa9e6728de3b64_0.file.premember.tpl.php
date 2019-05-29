<?php
/* Smarty version 3.1.30, created on 2019-05-20 21:45:42
  from "C:\xampp\htdocs\master\Section77Github\php_libs\smarty\templates\premember.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ce303e6a29c42_96036958',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1fd504bf2d63a802a7ebd2c89faa9e6728de3b64' => 
    array (
      0 => 'C:\\xampp\\htdocs\\master\\Section77Github\\php_libs\\smarty\\templates\\premember.tpl',
      1 => 1558381173,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ce303e6a29c42_96036958 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
<hr>
    <table style="margin: 0 auto;">
      <tr>
        
      <td> <a href="index.php">トップページへ</a>
      </td>
        
      <td>
  		<?php echo $_smarty_tpl->tpl_vars['message']->value;?>


        </td>
      </tr>
    </table>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html>
<?php }
}
