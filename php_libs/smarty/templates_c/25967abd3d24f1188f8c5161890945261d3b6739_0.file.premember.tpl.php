<?php
/* Smarty version 3.1.30, created on 2019-03-10 15:02:40
  from "C:\xampp\htdocs\master\Section77\php_libs\smarty\templates\premember.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5c851900c20742_24540209',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '25967abd3d24f1188f8c5161890945261d3b6739' => 
    array (
      0 => 'C:\\xampp\\htdocs\\master\\Section77\\php_libs\\smarty\\templates\\premember.tpl',
      1 => 1550474780,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c851900c20742_24540209 (Smarty_Internal_Template $_smarty_tpl) {
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
    <table>
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
