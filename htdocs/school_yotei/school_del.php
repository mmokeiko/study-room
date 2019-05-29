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

<h2>● 自習室の予約を削除する</h2>

<!-- center start -->
<div id="center">
<p>削除したい予約を下記から選んで、予約を削除ボタンをクリックしてください。</p>

<table id="yotei">
<tr>
<th class="day">月日</th>
<th class="time">時間</th>
<th class="name">名前</th>
<th class="shozoku">所属</th>
<th class="room">自習室</th>
<th class="biko">備考</th>
<th class="member">選択ボタン</th>
</tr>

<!--ここからループ -->
<?php
	// 表示
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
			$name = $res["name"];
			$shozoku = $res["shozoku"];
			$room = $res["room"];
                        $roomname ="";
                        foreach($room_data as $room_data_key => $room_data_val){
                        //key⇒データ　val⇒表示
    
                            if($room == $room_data_key){ //一致していたら
                                $roomname = $room_data_val;
                                //スコープの問題 room_data_valが外に持っていけない
                            } 
        
                        }
			$biko = $res["biko"];
			//$sankasya = $res["sankasya"];
			//$flag = $res["flag"];
			$id =  $res["id"];
			//EUC-JPからUTF-8に変換
			//mb_convert_variables("UTF-8", "EUC-JP", &$start_time, &$end_time, &$place, &$mensuu, &$sewanin, &$comment, &$sankasya, &$flag);
			mb_convert_variables($page_enc, $db_enc, $start_time);
			mb_convert_variables($page_enc, $db_enc, $end_time);
			mb_convert_variables($page_enc, $db_enc, $name);
			mb_convert_variables($page_enc, $db_enc, $shozoku);
			mb_convert_variables($page_enc, $db_enc, $roomname);
			mb_convert_variables($page_enc, $db_enc, $biko);
?>
<tr class="<?=$bgcolor_table?>">
<td class="center"><?=$start_day2?></td>
<td class="center"><?=$start_time?><br />
〜<br />
<?=$end_time?></td>
<td class="center"><?=$name?></td>
<td class="center"><?=$shozoku?></td>
<td  class="center"><?=$roomname?></td>
<td  class="center"><?=$biko?></td>

<td>
<form name="" method="post" action="school_del2.php" />
<input type="submit" name="submit" value="予約を削除" />
<input type="hidden" name="id" value="<?=$id?>" />
</form>
</td>
</tr>
<?php
		}
	}
?>
<!--ここまでループ -->
</table>

</div>
<!-- center end -->

<?php

 } else {
    // 未認証
    // 移動
    header('Location: ../index.php');
    exit();
}
?>