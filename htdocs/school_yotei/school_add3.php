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
// データベースへ接続する
$pdo = db_connect();

//$_SESSION["uid"]が存在し、かつ$admin_passと一致したら
//if(isset($_SESSION["uid"]) && $_SESSION["uid"] == crypt($admin_pass, $_SESSION["uid"])) {
	//check_input();
	//エラー処理用変数
	$err=0;
	$mes="";
	//エラーチェック
	if($date1==""){$err++;$mes.="date1が正確でありません。<br />";}
	if($time1==""){$err++;$mes.="time1が正確でありません。<br />";}
	if($date2==""){$err++;$mes.="date2が正確でありません。<br />";}
	if($time2==""){$err++;$mes.="time2が正確でありません。<br />";}
	if($name==""){$err++;$mes.="nameが正確でありません。<br />";}
        if($shozoku=="▼選択してください"){$err++;$mes.="shozokuが正確でありません。<br />";}
        if($room=="▼選択してください"){$err++;$mes.="roomが正確でありません。<br />";}
        //if($biko==""){$err++;$mes.="bikoが正確でありません。<br />";}	
	if($flag==""){$err++;$mes.="flagが正確でありません。<br />";}
	if($timestamp==""){$err++;$mes.="timestampが正確でありません。<br />";}
	if($err!=0) {
		err_msg($mes);
		//exit;
	} else {
		$biko= str_replace("&lt;br /&gt;", "<br />", $biko);
		//今はUTF-8に統一されている
                
		mb_convert_variables($db_enc, $page_enc, $time1);
		mb_convert_variables($db_enc, $page_enc, $time2);
		mb_convert_variables($db_enc, $page_enc, $name);
		mb_convert_variables($db_enc, $page_enc, $shozoku);
		mb_convert_variables($db_enc, $page_enc, $room);
		mb_convert_variables($db_enc, $page_enc, $biko);
		// データベースに保存　ここのカラム名を変える必要がある
		$sql = "insert into "."$yotei_table"." (date1,time1,date2,time2,name,shozoku,room,biko,flag,timestamp) values ('$date1','$time1','$date2','$time2','$name','$shozoku','$room','$biko','$flag','$timestamp')";
                $stmt = db_executeSQL($pdo, $sql, NULL);
?>

<?php
	//ヘッダー部分表示
	html_header();
	//ジャンプメニュー部分表示
	html_header2();
?>

<h2>自習室の予約を追加しました。</h2>

<!-- center start -->
<div id="center">
<div id="main">
<p class="welcome">自習室の予約が追加されているかを確認するには、トップ画面を表示してください。</p>
<ul>
<li><a href="<?=$fileTOP?>">● トップ画面</a></li>
<li><a href="<?=$fileADD?>">● 自習室予約を追加する</a></li>
<li><a href="<?=$fileEDIT?>">● 自習室予約を変更する</a></li>
<li><a href="<?=$fileDEL?>">● 自習室予約を削除する</a></li>
</ul>
</div>
</div>
<!-- center end -->

<?php
		exit();
	}
	exit();
//$_SESSION["uid"]が存在せず、または$admin_passと一致しなかったら
 }
        
         else {
    // 未認証
    // 移動
    header('Location: ../index.php');
    exit();
}
?>