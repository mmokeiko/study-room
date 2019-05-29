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
	if($date1_year=="" || $date1_month=="" || $date1_day==""){$err++;$mes.="date1が正確でありません。";}
	if($time1_hour=="" || $time1_minute==""){$err++;$mes.="time1が正確でありません。";}
	if($time2_hour=="" || $time2_minute==""){$err++;$mes.="time2が正確でありません。";}
        if($name==""){$err++;$mes.="nameが正確でありません。";}
	if($shozoku=="▼選択してください"){$err++;$mes.="shozokuが正確でありません。";}
	if($room=="▼選択してください"){$err++;$mes.="roomが正確でありません。";}
	if($biko==""){$err++;$mes.="bikoが正確でありません。";}
	if($id==""){$err++;$mes.="idが正確でありません。";}
	if($err!=0) {
		err_msg($mes);
		exit;
	} else {
		// 日付データ$date1 を作成
		$date_array = array($date1_year, $date1_month, $date1_day);
		$date1 = implode("-", $date_array);
		
		$date2 = $date1;
		
		// 時間データ $time1を作成
		$time1 = "$time1_hour".'時'."$time1_minute".'分';
		
		// 時間データ $time2を作成
		$time2 = "$time2_hour".'時'."$time2_minute".'分';
		
		// timstamp データを作成
		// #2 Deprecated: mktime(): The is_dst parameter is deprecated in
		$timestamp_b = mktime($time1_hour,$time1_minute,0,$date1_month,$date1_day,$date1_year);
		$timestamp = date("Y-m-d H:i:s", $timestamp_b);
		//$timestamp .= +09;
		
		
		mb_convert_variables($db_enc, $page_enc, $time1);
		mb_convert_variables($db_enc, $page_enc, $time2);
		mb_convert_variables($db_enc, $page_enc, $name);
		mb_convert_variables($db_enc, $page_enc, $shozoku);
		mb_convert_variables($db_enc, $page_enc, $room);
		mb_convert_variables($db_enc, $page_enc, $biko);

		// データベースに保存
		$sql = "update "."$yotei_table"." set date1 = '"."$date1"."' , time1 = '"."$time1"."' , date2 = '"."$date2"."' , time2 = '"."$time2"."' ,name = '"."$name"."' , shozoku = '"."$shozoku"."' , room = '"."$room"."' , biko = '"."$biko"."' , timestamp = '"."$timestamp"."' where id = "."$id";
		$stmt = db_executeSQL($pdo, $sql, NULL);
?>

<h2>自習室の予約を変更しました。</h2>

<div id="center">
<div id="main">
<p class="welcome">自習室の予約が変更されているかを確認するには、トップ画面を表示してください。</p>
<ul>
<li><a href="<?=$fileTOP?>">● トップ画面</a></li>
<li><a href="<?=$fileADD?>">● 自習室予約を追加する</a></li>
<li><a href="<?=$fileEDIT?>">● 自習室予約を変更する</a></li>
<li><a href="<?=$fileDEL?>">● 自習室予約を削除する</a></li>
</ul>
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

        
        }else {
	// 未認証
    // 移動
    header('Location: ../index.php');
    exit();
}
?>