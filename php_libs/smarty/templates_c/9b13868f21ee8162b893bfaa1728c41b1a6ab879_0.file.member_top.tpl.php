<?php
/* Smarty version 3.1.30, created on 2019-05-12 14:02:36
  from "C:\xampp\htdocs\master\Section77\php_libs\smarty\templates\member_top.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cd80b5cb192b1_29998533',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b13868f21ee8162b893bfaa1728c41b1a6ab879' => 
    array (
      0 => 'C:\\xampp\\htdocs\\master\\Section77\\php_libs\\smarty\\templates\\member_top.tpl',
      1 => 1557662555,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cd80b5cb192b1_29998533 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>
<body>
<div style="text-align:center;
     ">
<hr>
<strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
<hr>
    <table>
      <tr>
      <td style="vertical-align:top;">
                 
                 
            [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=logout">ログアウト</a> ]
	<br>
	<br>
	<?php echo $_smarty_tpl->tpl_vars['disp_login_state']->value;?>


      </td>
        <td style="vertical-align:top;">
        <div style="text-align: left; margin-left:15px;">
          <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['last_name']->value, ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_name']->value, ENT_QUOTES, 'UTF-8', true);?>
 さん、こんにちは！
          <br>
          <!-- ログイン認証チェック付き画面遷移のテスト -->
          <br>
	        <a href="school_yotei/school_add.php">自習室予約を追加する</a>
          <br>
          <br>
	        <a href="school_yotei/school_edit.php">自習室予約を変更する</a>
          <br>
          <br>
	        <a href="school_yotei/school_del.php">自習室予約を削除する</a>
          <br>  
          <br>
	        <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=modify&action=form">会員登録情報の修正</a>
          <br>
          <br>
	        <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=delete&action=confirm">退会する</a>
          <br>

        </div>
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
