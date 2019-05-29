<?php
/* Smarty version 3.1.30, created on 2019-04-24 11:57:58
  from "C:\xampp\htdocs\master\Section77\php_libs\smarty\templates\member_top.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cc033261ec3d1_67274844',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b6a778c6882a577e9bac7eb628209b3eac7ba13' => 
    array (
      0 => 'C:\\xampp\\htdocs\\master\\Section77\\php_libs\\smarty\\templates\\member_top.php',
      1 => 1556099736,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cc033261ec3d1_67274844 (Smarty_Internal_Template $_smarty_tpl) {
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
          <!-- 星川追加 start -->
          
          
          
          <!-- ログイン認証チェック付き画面遷移のテスト -->
          <br>
	        <a href="deep_tennis_add.php">自習室予約を追加する</a>
          <br>
          <br>
	        <a href="deep_tennis_edit.php">自習室予約を変更する</a>
          <br>
          <br>
	        <a href="deep_tennis_del.php">自習室予約を削除する</a>
          <br>
          <br>
	        <a href="jishu_yoyaku.php">自習室予約(仮)追加</a>
          <br>
          
          
          <!-- 星川追加 end -->
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

<?php echo '<?php
 ';?>require_once '../../php_libs/init.php';

 if (checkLogin()) {
    // 認証済み
    // 初期設定を読み込む
 require_once("ini_02.php");

    // 関数ライブラリを読み込む
 require_once("lib_02.php");

 // データの入力チェック
 check_input(); 
 //ヘッダー部分表示
 html_header();
 //ジャンプメニュー部分表示
 html_header2();
 
 // データベースへ接続する
$pdo = db_connect();
<?php echo '?>';?>



<?php echo '<?php
	';?>//ヘッダー部分表示
	html_header();
<?php echo '?>';?>

<body>
<!-- container start -->
<div id="container">
<div id="header">
<div id="headerLeft">
<h1><?php echo '<?=';?>$appli_name<?php echo '?>';?></h1>
</div>
<div id="headerRight">　
</div>
</div>
<p class="header">● 参加希望の方はログインして参加表明してください。パスワードがわからない場合は、<?php echo '<?=';?>$syusaisya<?php echo '?>';?>までご連絡ください。</p>


<!-- center start -->
<div id="center">
<table id="yotei">
<tr>
<th class="day">月日</th>
<th class="time">時間</th>
<th class="place">場所</th>
<th class="court">面数</th>
<th class="sewanin">世話人</th>
<th class="member">参加予定者</th>
</tr>

<!--ここからループ -->
<?php echo '<?php
	';?>// 表示
	// order by timestamp は、日時順にソートするためのもの
	// 将来的には、現時刻と比較して過去のものは$flagをたてる予定
	$sql = "select * from "."$yotei_table"." where flag= 0 order by timestamp";        
        $stmt = db_executeSQL($pdo, $sql, NULL);
        $count = $stmt->rowCount();
        if($count > 0){
		// テーブルのレコード背景色用変数（奇数と偶数で異なる色にするため）
		$bgcolor_num = 2;
                while($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$bg = $bgcolor_num % 2;
			if($bg == 0) {
				$bgcolor_table = "BBB";
			} else {
				$bgcolor_table = "AAA";
			}
			$bgcolor_num++;
			
			$start_day = explode("-", $res["date1"]);
			$year = $start_day[0];
			$month = $start_day[1];
			$day = $start_day[2];

			// #2 Deprecated: mktime(): The is_dst parameter is deprecated in
			$the_time = mktime(0,0,0,$month,$day,$year);

			$youbi = date("l", $the_time);
			// 曜日を日本語になおす関数のよびだし
			$youbi2 = youbi_henkan($youbi);
			
			// 月のケタをなおす
			if($month == "01") {
				$month = "1";
			} else if($month == "02") {
				$month = "2";
			} else if($month == "03") {
				$month = "3";
			} else if($month == "04") {
				$month = "4";
			} else if($month == "05") {
				$month = "5";
			} else if($month == "06") {
				$month = "6";
			} else if($month == "07") {
				$month = "7";
			} else if($month == "08") {
				$month = "8";
			} else if($month == "09") {
				$month = "9";
			}
			
			// 日のケタをなおす
			if($day == "01") {
				$day = "1";
			} else if($day == "02") {
				$day = "2";
			} else if($day == "03") {
				$day = "3";
			} else if($day == "04") {
				$day = "4";
			} else if($day == "05") {
				$day = "5";
			} else if($day == "06") {
				$day = "6";
			} else if($day == "07") {
				$day = "7";
			} else if($day == "08") {
				$day = "8";
			} else if($day == "09") {
				$day = "9";
			}
			
			$start_day2 = "$month".'／'."$day";
			$start_day2 .= $youbi2;
			// 日付の完成スタイルは「4／5（火）」のようになる
			
			$start_time = $res["time1"];
			$end_time = $res["time2"];
			$place = $res["place"];
			$mensuu = $res["mensuu"];
			$sewanin = $res["sewanin"];
			$comment = $res["comment"];
			$sankasya = $res["sankasya"];
			//<br>を<br />に置換
			$sankasya = str_replace("<br>", "<br />", $sankasya);
			$flag = $res["flag"];
			//EUC-JPからUTF-8に変換
			//mb_convert_variables("UTF-8", "EUC-JP", &$start_time, &$end_time, &$place, &$mensuu, &$sewanin, &$comment, &$sankasya, &$flag);
			mb_convert_variables($page_enc, $db_enc, $start_time);
			mb_convert_variables($page_enc, $db_enc, $end_time);
			mb_convert_variables($page_enc, $db_enc, $place);
			mb_convert_variables($page_enc, $db_enc, $mensuu);
			mb_convert_variables($page_enc, $db_enc, $sewanin);
			mb_convert_variables($page_enc, $db_enc, $comment);
			mb_convert_variables($page_enc, $db_enc, $sankasya);

<?php echo '?>';?>
<tr class="<?php echo '<?=';?>$bgcolor_table<?php echo '?>';?>">
<td class="center"><?php echo '<?=';?>$start_day2<?php echo '?>';?></td>
<td class="center"><?php echo '<?=';?>$start_time<?php echo '?>';?><br />
〜<br />
<?php echo '<?=';?>$end_time<?php echo '?>';?></td>
<td class="center"><?php echo '<?=';?>$place<?php echo '?>';?></td>
<td class="center"><?php echo '<?=';?>$mensuu<?php echo '?>';?> 面</td>
<td  class="center"><?php echo '<?=';?>$sewanin<?php echo '?>';?><br />
<?php echo '<?php
	';?>if($comment) {
<?php echo '?>';?>
<div class="comment"><?php echo '<?=';?>$comment<?php echo '?>';?></div>
<?php echo '<?php
	';?>}
<?php echo '?>';?>
</td>
<td><?php echo '<?=';?>$sankasya<?php echo '?>';?></td>
</tr>
<?php echo '<?php
		';?>}
	}
<?php echo '?>';?>
<!--ここまでループ -->

</table>

<form method="post" action="<?php echo '<?=';?>$fileMAIN<?php echo '?>';?>">
<div>テニスの予定の追加・変更・削除、参加の表明・取り消しはこちらから→
<input type="password" id="pass" name="pass" value="" />
<input type="submit" value="ログイン" id="submit" name="submit" /></div>
</form>

</div>
<!-- center end -->

<?php echo '<?php
	';?>//フッター部分表示
	html_footer();
<?php echo '?>';?>

<?php echo '<?php
	';?>// 切断
	//$db->disconnect();
 } else {
    // 未認証
    // 移動
    header('Location: ../index.php');
    exit();
}
<?php echo '?>';
}
}
