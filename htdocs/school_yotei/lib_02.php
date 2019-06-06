<?php

//----------------------------------------------------
// データベース関連
//----------------------------------------------------
/**
 * PDOインスタンスを作成し、DBに接続する。
 * 接続に必要なパラメータ(_DSN, _DB_USER, _DB_PASS)は、別途定数で定義。
 *
 * @param なし
 * @return PDOオブジェクト
 */
function db_connect(){
    try {
      $pdo = new PDO(_DSN, _DB_USER, _DB_PASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch(PDOException $Exception) {
      die('エラー :' . $Exception->getMessage());
    }
    return $pdo;
    
}

/**
 * PDOを使って、SQLを実行
 * 接続に必要なパラメータ(_DSN, _DB_USER, _DB_PASS)は、別途定数で定義。
 *
 * @param SQLステートメント。
 * @param execute() にわたす[array input_parameters]パラメータのarray。パラメータマーカに PHP 変数をバインドする
 * @return 成功した場合は、PDOStatementオブジェクトを返す。例外発生時はfalseを返す。
 */
function db_executeSQL($pdo, $sql, $array){
    try{
        //if(!$pdo = $this->db_connect())return false;
        $stmt = $pdo->prepare($sql);
        $stmt->execute($array);
        return $stmt;
    }catch(Exception $e){
        return false;
    }
}

//----------------------------------------------------
// パスワード関連
//----------------------------------------------------
function get_hashed_password($password){
    
    // ******** PHP7.0より下位バージョンの対応 START ******** 
    $ver_php_current = phpversion(); // 現在のバージョン (7.0.22)
    $ver_php_require = '7.0';     // 必要最低バージョン
    $ver_operator    = '<';          // より下

    if (version_compare($ver_php_current, $ver_php_require, $ver_operator)) {
        global $admin_pass;
        // コストパラメーター
        // 04 から 31 までの範囲 大きくなれば堅牢になりますが、システムに負荷がかかります。
        $cost = 10;

        // ランダムな文字列を生成します。
        $salt = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 16);

        // ソルトを生成します。
        $salt = sprintf("$2y$%02d$", $cost) . $salt;
        $hash = crypt($password, $salt);
        return $hash;
    
    }
    // ******** PHP7.0より下位バージョンの対応 END ******** 
    
    // コストパラメーター
    // 04 から 31 までの範囲 大きくなれば堅牢になりますが、システムに負荷がかかります。
    $cost = 10;

    // ランダムな文字列を生成します。
    $salt = strtr(base64_encode(random_bytes(16)), '+', '.');

    // ソルトを生成します。
    $salt = sprintf("$2y$%02d$", $cost) . $salt;
    $hash = crypt($password, $salt);
    return $hash;
}

    // パスワードが一致したらtrueを返します
function check_password($password, $hashed_password){
    
    // ******** PHP7.0より下位バージョンの対応 START ******** 
    $ver_php_current = phpversion(); // 現在のバージョン
    $ver_php_require = '7.0';     // 必要最低バージョン
    $ver_operator    = '<';          // より下
    
    if (version_compare($ver_php_current, $ver_php_require, $ver_operator)) {
        if ($hashed_password == crypt($password, $hashed_password)) {
            return true;
        } else {
            return false;
        }
    }
    // ******** PHP7.0より下位バージョンの対応 END ******** 
    
    // postで受け取ったパスワード文字列（$password）と、DBから取得したパスワード文字列（$hashed_password）
    if (hash_equals($hashed_password, crypt($password, $hashed_password))) {
        return true;
    }
}
    
	// 共通<head>部分
	function html_header() {
		global $title, $rootURL, $page_enc, $fileCSS, $fileJS;
		
		print "<!DOCTYPE html>
<html lang=\"ja\"><head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-141271019-1\"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-141271019-1');
</script>

<title>".$title."</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$page_enc."\" />
<meta http-equiv=\"Content-Language\" content=\"ja\" />
<meta http-equiv=\"Content-Style-Type\" content=\"text/css\" />
<meta http-equiv=\"Content-Script-Type\" content=\"text/javascript\" />
<meta http-equiv=\"Cache-control\" content=\"no-cache\" />
<meta http-equiv=\"Pragma\" content=\"no-cache\" />
<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$fileCSS."\" />
<script type=\"text/javascript\" src=\"".$fileJS."\"></script>
</head>";
	}

	//共通ヘッダージャンプメニュー部分
	function html_header2() {
		global $appli_name, $fileTOP, $fileADD, $fileEDIT, $fileDEL;
		print "<body>
<!-- container start -->
<div id=\"container\">
<div id=\"header\">
<div id=\"headerLeft\">
<h1>$appli_name</h1>
</div>
<div id=\"headerRight\">
<form action=\"\">
<select id=\"pageJump\" onChange=\"MM_jumpMenu('parent',this,0)\">
<option selected>コマンド選択 </option>
<option value=\"$fileTOP\">トップ画面に戻る </option>
<option value=\"$fileADD\">予約を追加する </option>
<option value=\"$fileEDIT\">予約を変更する </option>
<option value=\"$fileDEL\">予約を削除する </option>
</select>
</form>
</div>
</div>";
	}
        
        //共通フッター部分
	function html_footer() {
		print "


<!-- container end -->
</body>
</html>";
	}
	
	// エラーメッセージ表示関数　戻るボタン（history.back()）
	function err_msg($msg) {
		global $title, $appli_name, $rootURL;
		html_header();
		print <<<_EOT_

<body>                   
<!-- container start -->
<div id="container">
<div id="header">
<div id="headerLeft">
<h1>$appli_name</h1>
</div>
<div id="headerRight">
</div>
</div>
<!-- center start -->
<div id="center">
<p>$msg</p>
<form id="btnBack" method="post" action="school_add.php">
 <p><a href="Javascript:history.back()">［ 戻る ］</a></p>
<!--<input type="button" id="btnBack" onclick="history.back()" value="戻る" />-->                  
</form>
</div>
<!-- center end -->
_EOT_;
		
		exit();
	}

	// 曜日変換ルーチン
	function youbi_henkan($youbi) {
                
		global $youbi, $value;
		if($youbi == "Sunday") {
			$value = "（日）";
		} else if($youbi == "Monday") {
			$value = "（月）";
		} else if($youbi == "Tuesday") {
			$value = "（火）";
		} else if($youbi == "Wednesday") {
			$value = "（水）";
		} else if($youbi == "Thursday") {
			$value = "（木）";
		} else if($youbi == "Friday") {
			$value = "（金）";
		} else if($youbi == "Saturday") {
			$value = "（土）";
		}
		return "$value";
	}
	
	// 入力データのチェック どこからでも呼び出せる変数を作っておく
	function check_input() {
		global $_POST, $pass, $date1_year, $date1_month, $date1_day, $time1_hour, $time1_minute, $date1, $time1, $date2, $time2;
		global $time2_hour, $time2_minute, $name, $shozoku, $room, $biko, $flag, $timestamp, $id, $cancel;

                // DBに有害な文字列を変換、HTMLタグ変換
                if (isset($_POST['pass'])) {
                    $pass = addslashes($_POST['pass']);
                    $pass = htmlspecialchars($pass);
                }
		
		if (isset($_POST['date1_year'])) {
                    $date1_year = addslashes($_POST['date1_year']);
                    $date1_year = htmlspecialchars($date1_year);
                }
                
                if (isset($_POST['date1_month'])) {
                    $date1_month = addslashes($_POST['date1_month']);
                    $date1_month = htmlspecialchars($date1_month);
                }
		
                if (isset($_POST['date1_day'])) {
                    $date1_day = addslashes($_POST['date1_day']);
                    $date1_day = htmlspecialchars($date1_day);
                }
		
		if (isset($_POST['time1_hour'])) {
                    $time1_hour = addslashes($_POST['time1_hour']);
                    $time1_hour = htmlspecialchars($time1_hour);
                }
                
                if (isset($_POST['time1_minute'])) {
                    $time1_minute = addslashes($_POST['time1_minute']);
                    $time1_minute = htmlspecialchars($time1_minute);
                }
                
                if (isset($_POST['time2_hour'])) {
                    $time2_hour = addslashes($_POST['time2_hour']);
                    $time2_hour = htmlspecialchars($time2_hour);
                }
		
		if (isset($_POST['time2_minute'])) {
                    $time2_minute = addslashes($_POST['time2_minute']);
                    $time2_minute = htmlspecialchars($time2_minute);
                }
                                  
                if (isset($_POST['name'])) {
                    $name = addslashes($_POST['name']);
                    $name = htmlspecialchars($name);
                }
                    
                if (isset($_POST['shozoku'])) {
                    $shozoku = addslashes($_POST['shozoku']);
                    $shozoku = htmlspecialchars($shozoku);
                }
                
                if (isset($_POST['room'])) {
                    $room = addslashes($_POST['room']);
                    $room = htmlspecialchars($room);
                }
            
                if (isset($_POST['biko'])) {
                    $biko = addslashes($_POST['biko']);
                    $biko = htmlspecialchars($biko);
                    $biko = nl2br($biko);
                    $biko = preg_replace("/[\r\n]/", "", $biko);
                    
                    $bikolen = strlen($_POST['biko']);
                    if ($biko > _COMMENT_LEN_MAX) {
			err_msg("備考欄の文字列が長すぎて適切ではありません。<br>");
			exit;
                    }
                }
                
                if (isset($_POST['date1'])) {
                    $date1 = addslashes($_POST['date1']);
                    $date1 = htmlspecialchars($date1);
                }
                
		if (isset($_POST['date2'])) {
                    $date2 = addslashes($_POST['date2']);
                    $date2 = htmlspecialchars($date2);
                }
                
                if (isset($_POST['time1'])) {
                    $time1 = addslashes($_POST['time1']);
                    $time1 = htmlspecialchars($time1);
                }
                
                if (isset($_POST['time2'])) {
                    $time2 = addslashes($_POST['time2']);
                    $time2 = htmlspecialchars($time2);
                }
                
                if (isset($_POST['flag'])) {
                    $flag = addslashes($_POST['flag']);
                    $flag = htmlspecialchars($flag);
                }
                
		if (isset($_POST['timestamp'])) {
                    $timestamp = addslashes($_POST['timestamp']);
                    $timestamp = htmlspecialchars($timestamp);
                }
                
		if (isset($_POST['id'])) {
                    $id = addslashes($_POST['id']);
                    $id = htmlspecialchars($id);
                }
                
		if (isset($_POST['cancel'])) {
                    $cancel = addslashes($_POST['cancel']);
                    $cancel = htmlspecialchars($cancel);
                }	
	}
        
    // DBに接続し、予定表を表示する
    function show_yotei() {
        // グローバル変数$yotei_tableにアクセスする準備
        global $yotei_table,$room_data;
        
        // データベースへ接続する
        $pdo = db_connect();
        
        // 変数初期化
        $youbi = "";
        $youbi2 = "";
        
        // 予定表のHTMLをechoで出力する
        echo '
<!-- 予約表 start --> <!-- cssファイルに記載する -->
<div style="        
text-align: center;
background:#fff;
font-size:120%;
line-height:130%;
margin: 0 auto;
" >

<table style="margin: 10px auto; border: solid 2px #000;">
<tr>
<th style="border: solid 1px #000;">月日</th>
<th style="border: solid 1px #000;">時間</th>
<th style="border: solid 1px #000;">名前</th>
<th style="border: solid 1px #000;">所属</th>
<th style="border: solid 1px #000;">自習室</th>
<th style="border: solid 1px #000;">備考</th>
</tr>

<!--ここからループ -->
        ';

        // 
	$sql = "select * from ".$yotei_table." where flag= 0 order by timestamp";        
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
			//<br>を<br />に置換
			//$sankasya = str_replace("<br>", "<br />", $sankasya);
			$flag = $res["flag"];
                        
                        echo '<tr class="'.$bgcolor_table.'">';
                        echo '<td style="border: solid 1px #000;">'.$start_day2.'</td>';
                        echo '<td style="border: solid 1px #000;">'.$start_time.'<br />';
                        echo '〜<br />';
                        echo $end_time.'</td>';
                        echo '<td style="border: solid 1px #000;">'.$name.'</td>';
                        echo '<td style="border: solid 1px #000;">'.$shozoku.'</td>';
                        echo '<td style="border: solid 1px #000;">'.$roomname.'</td>';
                        echo '<td style="border: solid 1px #000;">'.$biko.'</td>';                     
                        echo '</tr>';
                }
	}
        
        // 予定表のHTMLをechoで出力する
        echo '
<!--ここまでループ -->
</table>
</div>
<!-- 予定表 end -->
        ';
            
    }