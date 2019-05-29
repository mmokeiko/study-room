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
 //ヘッダー部分表示
 html_header();
 //ジャンプメニュー部分表示
 html_header2();
 
 // データベースへ接続する
$pdo = db_connect();
?>

<?php

//$_SESSION["uid"]が存在し、かつ$admin_passと一致したら
//if(isset($_SESSION["uid"]) && $_SESSION["uid"] == crypt($admin_pass, $_SESSION["uid"])) {
	//エラー処理用変数
	$err=0;
	$mes="";
	//エラーチェック
	if($id==""){$err++;$mes.="idが正確でありません。";}
	if($err!=0) {
		err_msg($mes);
		exit;
	} else {
		// データベースから一致するidのレコードを読みとる
		$sql = "select * from "."$yotei_table"." where id = "."$id";
		$stmt = db_executeSQL($pdo, $sql, NULL);
                $count = $stmt->rowCount();
                if($count > 0){
                    while($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
			if($res) {
				$start_day = explode("-", $res["date1"]);
				$date1_year = $start_day[0];
				$date1_month = $start_day[1];
				$date1_day = $start_day[2];
				//$the_time = mktime(0,0,0,$date1_month,$date1_day,$date1_year);
				//$youbi = date("l", $the_time);
				// 曜日を日本語になおす関数のよびだし
				//$youbi2 = youbi_henkan($youbi);
				// 月のケタをなおす
				if($date1_month == "01") {
					$date1_month = "1";
				} else if($date1_month == "02") {
					$date1_month = "2";
				} else if($date1_month == "03") {
					$date1_month = "3";
				} else if($date1_month == "04") {
					$date1_month = "4";
				} else if($date1_month == "05") {
					$date1_month = "5";
				} else if($date1_month == "06") {
					$date1_month = "6";
				} else if($date1_month == "07") {
					$date1_month = "7";
				} else if($date1_month == "08") {
					$date1_month = "8";
				} else if($date1_month == "09") {
					$date1_month = "9";
				}
				// 日のケタをなおす
				if($date1_day == "01") {
					$date1_day = "1";
				} else if($date1_day == "02") {
					$date1_day = "2";
				} else if($date1_day == "03") {
					$date1_day = "3";
				} else if($date1_day == "04") {
					$date1_day = "4";
				} else if($date1_day == "05") {
					$date1_day = "5";
				} else if($date1_day == "06") {
					$date1_day = "6";
				} else if($date1_day == "07") {
					$date1_day = "7";
				} else if($date1_day == "08") {
					$date1_day = "8";
				} else if($date1_day == "09") {
					$date1_day = "9";
				}
				// 現在の日付のデータが、それぞれ$date1_year,$date1_month,$date1_dayに入る
				
				//$start_day2 = "$date1_month".'／'."$date1_day";
				//$start_day2 .= $youbi2;
				// 日付の完成スタイルは「4／5（火）」のようになる
				$start_time = $res["time1"];
				$end_time = $res["time2"];
				mb_convert_variables($page_enc, $db_enc, $start_time);
				mb_convert_variables($page_enc, $db_enc, $end_time);

				$start_hour = explode("時", $start_time);
				$time1_hour = $start_hour[0];
				$start_minute = explode("分", $start_hour[1]);
				$time1_minute = $start_minute[0];

				// $time1_hour と $time1_minute が開始時刻の数値になる
				$end_hour = explode("時", $end_time);
				$time2_hour = $end_hour[0];
				$end_minute = explode("分", $end_hour[1]);
				$time2_minute = $end_minute[0];

				// $time2_hour と $time2_minute が終了時刻の数値になる
				$name = $res["name"];
				$shozoku = $res["shozoku"];
				$room = $res["room"];
				$biko = $res["biko"];
				//$flag = $res["flag"];
				//EUC-JPからUTF-8に変換
				//mb_convert_variables("UTF-8", "EUC-JP", &$start_time, &$end_time, &$place, &$mensuu, &$sewanin, &$comment, &$sankasya, &$flag);
				mb_convert_variables($page_enc, $db_enc, $time1_hour);
				mb_convert_variables($page_enc, $db_enc, $time1_minute);
				mb_convert_variables($page_enc, $db_enc, $time2_hour);
				mb_convert_variables($page_enc, $db_enc, $time2_minute);
				mb_convert_variables($page_enc, $db_enc, $start_time);
				mb_convert_variables($page_enc, $db_enc, $end_time);
				mb_convert_variables($page_enc, $db_enc, $name);
				mb_convert_variables($page_enc, $db_enc, $shozoku);
				mb_convert_variables($page_enc, $db_enc, $room);
				mb_convert_variables($page_enc, $db_enc, $biko);

				// 時間データ $time1を作成
				//$time1 = "$time1_hour".'時'."$time1_minute".'分';
				$time1 = "$time1_hour".'時'."$time1_minute".'分';
				// 時間データ $time2を作成
				//$time2 = "$time2_hour".'時'."$time2_minute".'分';
				$time2 = "$time2_hour".'時'."$time2_minute".'分';

				//echo '$time1_hour = '.$time1_hour."\n";
				//echo '$time1_minute = '.$time1_minute."\n";
				//echo '$date1_month = '.$date1_month."\n";
				//echo '$date1_day = '.$date1_day."\n";
				//echo '$date1_year = '.$date1_year."\n";

				// timstamp データを作成
				// #2 Deprecated: mktime(): The is_dst parameter is deprecated in
				$timestamp_b = mktime($time1_hour,$time1_minute,0,$date1_month,$date1_day,$date1_year);
				$timestamp = date("Y-m-d H:i:s", $timestamp_b);
				//$timestamp .= +09;

				// 曜日を変数に保存
				$youbi = date("l", $timestamp_b);
				$youbi_j = youbi_henkan($youbi);
			}
                    }
                }
		
?>

<h2>● 自習室の予約を削除　確認画面</h2>

<!-- center start -->
<div id="center">
<p>
下記の予約を削除する場合は、自習室の予約を削除ボタンをクリックしてください。<br />
</p>

<table id="add">
<tr>
<td class="addLeft">日　時</td>
<td class="addRight">
<?php
	print "$date1_year".'年'."$date1_month".'月'."$date1_day".'日'."$youbi_j";
	print '　'."$time1".' 〜 '."$time2";
?>
</td>
</tr>
<tr>
<td class="addLeft">名　前</td>
<td class="addRight">
<?php
	print "$name";
?>
</td>
</tr>
<tr>
<td class="addLeft">所　属</td>
<td class="addRight">
<?php
	print "$shozoku";
?>
</td>
</tr>
<tr>
<td class="addLeft">自習室</td>
<td class="addRight">
<?php
	print "$room";
?>
</td>
</tr>
<tr>
<td class="addLeft">備　考</td>
<td class="addRight">
<?php
	print "$biko";
?>
</td>
</tr>
</table>

<div class="submitDel2">

<form id="btnDel" method="post" action="school_del3.php">
<input type="hidden" name="id" value="<?=$id?>" />
<input type="submit" id="btnDel" name="btnDel" value="自習室の予約を削除" />
</form>

<input type="button" id="btnDelBack" name="btnDelBack" value="一つ前に戻る" onClick="history.back()" />
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
} else {
    // 未認証
    // 移動
    header('Location: ../index.php');
    exit();
}
?>