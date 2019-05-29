<?php
/* Smarty version 3.1.30, created on 2019-04-04 07:32:56
  from "C:\xampp\htdocs\master\Section77\php_libs\smarty\templates\testlogin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ca59708e44032_02745377',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cedfee6d95e167790d52f2c9680f47fc3862525c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\master\\Section77\\php_libs\\smarty\\templates\\testlogin.tpl',
      1 => 1554355961,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ca59708e44032_02745377 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['title']->value;?>

<form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
<?php echo $_smarty_tpl->tpl_vars['form']->value['username']['label'];?>
:<br>
<?php echo $_smarty_tpl->tpl_vars['form']->value['username']['html'];?>
<br>
<?php echo $_smarty_tpl->tpl_vars['form']->value['password']['label'];?>
:<br>
<?php echo $_smarty_tpl->tpl_vars['form']->value['password']['html'];?>

<input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
<?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>

</form><?php }
}
