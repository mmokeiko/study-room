<?php
/* Smarty version 3.1.30, created on 2019-05-20 22:35:38
  from "C:\xampp\htdocs\master\Section77Github\php_libs\smarty\templates\message.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ce30f9a653461_88756185',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6b5baec51aa50a6c9e7d3426b916584abb4b66b5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\master\\Section77Github\\php_libs\\smarty\\templates\\message.tpl',
      1 => 1558382685,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ce30f9a653461_88756185 (Smarty_Internal_Template $_smarty_tpl) {
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
        
      <td style="vertical-align: top;">
	[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]
<?php if (($_smarty_tpl->tpl_vars['is_system']->value)) {?>
	<br>
	<br>
      	[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=list&action=form<?php echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">会員一覧</a> ]
<?php }?>
	<br>
	<br>
	<?php echo $_smarty_tpl->tpl_vars['disp_login_state']->value;?>

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
