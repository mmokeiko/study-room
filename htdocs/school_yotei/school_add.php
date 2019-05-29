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

?>
<h2>● 自習室の予約を追加する</h2>

<!-- center start -->
<div id="center">
<p><span class="green">※</span>は入力必須項目です。</p>
<form method="post" action="school_add2.php">

<table id="add">
<tr>
<td class="addLeft"><span class="green">※</span>日　時</td>
<td class="addRight">
<select id="date1_year" name="date1_year">
<?php
	for($i = date("Y") ; $i <= date("Y") + 1; $i++) {
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
			if($i == $time1_hour) {
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
		}  else {
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
			if($i == $time2_hour) {
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
	if(!$time2_minute) {    //最初に表示されたとき
		print '<option value="">--</option>' . "\n";
		print '<option value="00" selected>00</option>' . "\n";
		print '<option value="30">30</option>' . "\n";
	} else {
		 if($time2_minute == "30") {    //何か選ばれて確認画面から戻った時
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

<div class="submitbtnAddKakunin">
<input type="submit" id="btnAddKakunin" name="btnAddKakunin" value="確認画面" />

<input type="reset" id="btnAddReset" name="btnAddReset" value="リセット" />
</div>

</form>
</div>

<?php
	//フッター部分表示
	html_footer();
?>

<?php

    } else {
    // 未認証
    // 移動
    header('Location: ../index.php');
    exit();
    }
?>









