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
 
  // データベースへ接続する
  $pdo = db_connect();

  //ヘッダー部分表示
  html_header();
  //ジャンプメニュー部分表示
  html_header2();
?>

<?php
//$_SESSION["uid"]が存在し、かつ$admin_passと一致したら
//if(isset($_SESSION["uid"]) && $_SESSION["uid"] == crypt($admin_pass, $_SESSION["uid"])) {
	//エラー処理用変数
	$err=0;
	$mes="";
	//エラーチェック
	if($id==""){$err++;$mes.="idが正確でありません。".$syusaisya."まで連絡ください。<br />";}
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
			}
                    }
                }
		
?>



<h2>● 自習室の予定を変更する</h2>

<!-- center start -->
<div id="center">
<p>変更したい部分を修正してから、変更を確定するボタンをクリックしてください。</p>

<form method="post" action="school_edit3.php">

<table id="add">
<tr>
<td class="addLeft"><span class="green">※</span>日　時</td>
<td class="addRight">
<select id="date1_year" name="date1_year">
<?php
	for($i =$date1_year; $i <= $date1_year + 1; $i++) {
		if($date1_year) {
			if($i == $date1_year) {
				print '<option value="' . $i . '" selected>' . $i . '</option>' . "\n";
			} else {
				print '<option value="' . $i .'">' . $i . '</option>' . "\n";
			}
		} else {
			if($i == date("Y")) {
				print '<option value="' . $i . '" selected>' . $i . '</option>' . "\n";
			} else {
				print '<option value="' . $i .'">' . $i . '</option>' . "\n";
			}
		}
	}
?>
</select>年

<select id="date1_month" name="date1_month">
<?php
	for($i=1; $i<=12; $i++) {
		if($date1_month) {
			if($i == $date1_month) {
				print '<option value="' . $i . '" selected>' . $i . '</option>' . "\n";
			} else {
				print '<option value="' . $i .'">' . $i . '</option>' . "\n";
			}
		} else {
			if($i == date("n")) {
				print '<option value="' . $i .'" selected>' . $i . '</option>' . "\n";
			} else {
				print '<option value="' . $i .'">' . $i . '</option>' . "\n";
			}
		}
	}
?>
</select>月

<select id="date1_day" name="date1_day">
<?php
	for($i = 1; $i <= 31; $i++) {
		if($date1_day) {
			if($i == $date1_day) {
				print '<option value="' . $i . '" selected>' . $i . '</option>' . "\n";
			} else {
				print '<option value="' . $i .'">' . $i . '</option>' . "\n";
			}
		} else {
			if($i == date("j")) {
				print '<option value="' . $i .'" selected>' . $i . '</option>' . "\n";
			} else {
				print '<option value="' . $i .'">' . $i . '</option>' . "\n";
			}
		}
	}
?>
</select>日<br class="addRight" />

<select id="time1_hour" name="time1_hour">
<option value="">--</option>
<?php
	for($i = 9; $i <= 22; $i++) {
		if(isset($time1_hour)) {
			if($i == (int)$time1_hour) {
				print '<option value="' . $i . '" selected>' . $i . '</option>' . "\n";
			} else {
				print '<option value="' . $i .'">' . $i . '</option>' . "\n";
			}
		} else {
			print '<option value="' . $i .'">' . $i . '</option>' . "\n";
		}
	}
?>
</select>時

<select id="time1_minute" name="time1_minute">
<?php
	if(!$time1_minute) {
		print '<option value="">--</option>' . "\n";
		print '<option value="00" selected>00</option>' . "\n";
		print '<option value="30">30</option>' . "\n";
	} else {
		if($time1_minute == "30") {
			print '<option value="">--</option>' . "\n";
			print '<option value="00">00</option>' . "\n";
			print '<option value="30" selected>30</option>' . "\n";		
		} else {
			print '<option value="">--</option>' . "\n";
			print '<option value="00" selected>00</option>' . "\n";
			print '<option value="30">30</option>' . "\n";			
		}
	}
?>
</select>分 〜

<select id="time2_hour" name="time2_hour">
<option value="">--</option>
<?php
	for($i = 9; $i <= 23; $i++) {
		if(isset($time2_hour)) {
			if($i == (int)$time2_hour) {
				print '<option value="' . $i . '" selected>' . $i . '</option>' . "\n";
			} else {
				print '<option value="' . $i .'">' . $i . '</option>' . "\n";
			}
		} else {
			print '<option value="' . $i .'">' . $i . '</option>' . "\n";
		}
	}
?>
</select>時

<select id="time2_minute" name="time2_minute">
<?php
	if(!$time2_minute) {
		print '<option value="">--</option>' . "\n";
		print '<option value="00" selected>00</option>' . "\n";
		print '<option value="30">30</option>' . "\n";	
	} else {
		if($time2_minute == "30") {
			print '<option value="">--</option>' . "\n";
			print '<option value="00">00</option>' . "\n";
			print '<option value="30" selected>30</option>' . "\n";			
		} else {
			print '<option value="">--</option>' . "\n";
			print '<option value="00" selected>00</option>' . "\n";	
			print '<option value="30">30</option>' . "\n";
		}
	}
?>
</select>分

</td>
</tr>

<tr>
<td class="addLeft"><span class="green">※</span>名前</td>
<td class="addRight">
<?php
if($name) {
		print '<input type="text" id="name" name="name" size="10" maxlength="10" value="'.$name.'"/>' . "\n";
	} else {
		print '<input type="text" id="name" name="name" size="10" maxlength="10" value="" />' . "\n";
	}
?>
<br class="addRight">
</td>
</tr>

<tr>
<td class="addLeft"><span class="green">※</span>所属</td>
<td class="addRight">
<?php

// 配列のデータをoptionタグに整形
$shozoku_option = "";

if(!$shozoku ){ //最初に表示されたとき
    foreach($shozoku_data as $shozoku_data_key => $shozoku_data_val){
        $shozoku_option .= "<option value='". $shozoku_data_key;
        $shozoku_option .= "'>". $shozoku_data_val. "</option>";
    }

} else{
    foreach($shozoku_data as $shozoku_data_key => $shozoku_data_val){
        //key⇒データ　val⇒表示
    
        if($shozoku == $shozoku_data_key){ //一致していたら
            $shozoku_option .= "<option value='". $shozoku_data_key;
            $shozoku_option .= "' selected>". $shozoku_data_val. "</option>";
        } else{ //一致していない場合
            $shozoku_option .= "<option value='". $shozoku_data_key;
            $shozoku_option .= "'>". $shozoku_data_val. "</option>";
        }
        
    }
    
}

?>
    
<select name='shozoku'>
    <?php
        echo $shozoku_option;
    ?>
</select>
<br class="addRight" />
</td>
</tr>

<tr>
<td class="addLeft"><span class="green">※</span>自習室</td>
<td class="addRight">

<?php
// 配列のデータをoptionタグに整形
$room_option = "";


    if(!$room ){ //最初に表示されたとき
    foreach($room_data as $room_data_key => $room_data_val){
        $room_option .= "<option value='". $room_data_key;
        $room_option .= "'>". $room_data_val. "</option>";
    }

} else{
    foreach($room_data as $room_data_key => $room_data_val){
        //key⇒データ　val⇒表示
    
        if($room == $room_data_key){ //一致していたら
            $room_option .= "<option value='". $room_data_key;
            $room_option .= "' selected>". $room_data_val. "</option>";
        } else{ //一致していない場合
            $room_option .= "<option value='". $room_data_key;
            $room_option .= "'>". $room_data_val. "</option>";
        }
        
    }
    
}

?>
    
<select name='room'>
    <?php
        echo $room_option;
    ?>
</select>
<br class="addRight" />
</td>
</tr>

<tr>
<td class="addLeft">備考</td>
<td class="addRight">
<?php

	if($biko) {
		//<br />を\nに変換する
		$biko = str_replace("&lt;br /&gt;", "\n", $biko);
		print '<textarea id="biko" name="biko" cols="30" rows="5">'.$biko.'</textarea>' . "\n";
	} else {
		print '<textarea id="biko" name="biko" cols="30" rows="5"></textarea>' . "\n";
	}
?>
<br class="addRight">
</td>
</tr>
</table>

<div class="submitEdit2">

<input type="submit" id="btnAdd" name="btnAdd" value="変更を確定する" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="button" id="btnEdit" name="btnEdit" value="一つ前に戻る" onClick="history.back()" />

</div>


</form>
</div>
<!-- center end -->

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