<?php
 //define('_ROOT_DIR', __DIR__ . '/');
 //require_once _ROOT_DIR . '../php_libs/init.php';
   
require_once '../../php_libs/init.php';
  
 if (checkLogin()) {
    // 認証済み
    // 初期設定を読み込む
 require_once("ini_02.php");

    // 関数ライブラリを読み込む
 require_once("lib_02.php");

 // データの入力チェック
 check_input(); 
?>

<?php
	//エラー処理用変数
	$err=0;
	$mes="";
	//エラーチェック
	if($date1_year=="" || $date1_month=="" || $date1_day==""){$err++;$mes.="日時が正確でありません。<br />";}
	if(!checkdate($date1_month, $date1_day, $date1_year)){$err++;$mes.="日時が正確でありません。<br />";}
	if($time1_hour=="" || $time1_minute==""){$err++;$mes.="開始時刻が選択されていません。<br />";}
	if($time2_hour=="" || $time2_minute==""){$err++;$mes.="終了時刻が選択されていません。<br />";}
        if($name==""){$err++;$mes.="名前が入力されていません。<br />";}
	if($shozoku=="▼選択してください"){$err++;$mes.="所属が選択されていません。<br />";}
	if($room=="▼選択してください"){$err++;$mes.="自習室が選択されていません。<br />";}
	if($err!=0) {
		err_msg($mes);
		exit;
	} else {
		// deep_tennis_add.php より送られてきた変数をチェックする
		// $date1_year, $date1_month, $date1_day, $time1_hour, $time1_minute,
		// $time2_hour, $time2_minute, $place, $place2, $mensuu, $sewanin, $comment
		
		// 日付データ$date1 を作成
		$date_array = array($date1_year, $date1_month, $date1_day);
		$date1 = implode("-", $date_array);
		
		// 時間データ $time1を作成
		$time1 = "$time1_hour".'時'."$time1_minute".'分';
		
		// 時間データ $time2を作成
		$time2 = "$time2_hour".'時'."$time2_minute".'分';
                
                // 時間データ $time2を作成
		$time2 = "$time2_hour".'時'."$time2_minute".'分';
			
		// timstamp データを作成
		// #2 Deprecated: mktime(): The is_dst parameter is deprecated in
		$timestamp_b = mktime($time1_hour,$time1_minute,0,$date1_month,$date1_day,$date1_year);
		$timestamp = date("Y-m-d H:i:s", $timestamp_b);
		//$timestamp .= +09;
		
		// 曜日を変数に保存
		$youbi = date("l", $timestamp_b);
		$youbi_j = youbi_henkan($youbi);
?>

<?php
	//ヘッダー部分表示
	html_header();
	//ジャンプメニュー部分表示
	html_header2();
?>

<h2>● 自習室の予約を追加する　確認画面</h2>

<!-- center start -->
<div id="center">
<p>
下記内容でよければ、データベースに追加ボタンをクリックしてください。<br />
修正する場合は、一つ前に戻るボタンをクリックしてください。
</p>

<table id="add">
<tr>
<td class="addLeft">日　時</td>
<td class="addRight">
<?php
	print "$date1_year".'年'."$date1_month".'月'."$date1_day".'日'."$youbi_j";
	print "$time1".' 〜 '."$time2";
?>
</td>
</tr>
<tr>
<td class="addLeft">名前</td>
<td class="addRight">
<?php
	print "$name";
?>
</td>
</tr>
<tr>
<td class="addLeft">所属</td>
<td class="addRight">
<?php
	//print "$shozoku";
        foreach($shozoku_data as $shozoku_data_key => $shozoku_data_val){
        //key⇒データ　val⇒表示
    
        if($shozoku == $shozoku_data_key){ //一致していたら
            print $shozoku_data_val;
        } 
        
    }
?>
</td>
</tr>
<tr>
<td class="addLeft">自習室</td>
<td class="addRight">
<?php
  
	//print "$room";
        //変数roomの中を条件式で組む
    foreach($room_data as $room_data_key => $room_data_val){
        //key⇒データ　val⇒表示
    
        if($room == $room_data_key){ //一致していたら
            print $room_data_val;
        } 
        
    }
?>
</td>
</tr>
<tr>
<td class="addLeft">備考</td>
<td class="addRight">
<?php
	print "$biko";
?>
</td>
</tr>
</table>

<div class="submit">

<form id="btnAdd" method="post" action="school_add3.php">
<input type="hidden" id="date1" name="date1" value="<?=$date1?>" />
<input type="hidden" id="time1" name="time1" value="<?=$time1?>" />
<input type="hidden" id="date2" name="date2" value="<?=$date1?>" />
<input type="hidden" id="time2" name="time2" value="<?=$time2?>" />
<input type="hidden" id="name" name="name" value="<?=$name?>" />
<input type="hidden" id="shozoku" name="shozoku" value="<?=$shozoku?>" />
<input type="hidden" id="room" name="room" value="<?=$room?>" />
<input type="hidden" id="biko" name="biko" value="<?=$biko?>" />

<input type="hidden" id="flag" name="flag" value="0" />
<input type="hidden" id="timestamp" name="timestamp" value="<?=$timestamp?>" />
<input type="submit" id="btnAdd" name="btnAdd" value="データベースに追加" />
</form>

<form id="btnEdit" method="post" action="school_add.php">
<input type="hidden" id="date1_year" name="date1_year" value="<?=$date1_year?>" />
<input type="hidden" id="date1_month" name="date1_month" value="<?=$date1_month?>" />
<input type="hidden" id="date1_day" name="date1_day" value="<?=$date1_day?>" />
<input type="hidden" id="time1_hour" name="time1_hour" value="<?=$time1_hour?>" />
<input type="hidden" id="time1_minute" name="time1_minute" value="<?=$time1_minute?>" />
<input type="hidden" id="time2_hour" name="time2_hour" value="<?=$time2_hour?>" />
<input type="hidden" id="time2_minute" name="time2_minute" value="<?=$time2_minute?>" />
<input type="hidden" id="name" name="name" value="<?=$name?>" />
<input type="hidden" id="shozoku" name="shozoku" value="<?=$shozoku?>" />
<input type="hidden" id="room" name="room" value="<?=$room?>" />
<input type="hidden" id="biko" name="biko" value="<?=$biko?>" />
<input type="hidden" id="flag" name="flag" value="0" />
<input type="hidden" id="timestamp" name="timestamp" value="<?=$timestamp?>" />
<input type="button" id="btnEdit" name="btnEdit" onclick="history.back()" value="修正する"  />
</form>
</div>


</div>

<?php
	//フッター部分表示
	html_footer();
?>


<?php
		exit();
	}
	exit();
//$_SESSION["uid"]が存在せず、または$admin_passと一致しなかったら
} else {
    // 未認証
    // 移動
    header('Location: ../index.php');
    exit();
  }
 
?>
