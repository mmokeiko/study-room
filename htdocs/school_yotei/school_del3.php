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
		// データベースに保存
		$sql = "update "."$yotei_table"." set flag = 3"." where id = "."$id";
		$stmt = db_executeSQL($pdo, $sql, NULL);
?>

<h2>自習室の予約を削除しました。</h2>

<div id="center">
<div id="main">
<p class="welcome">自習室の予約が削除されているかを確認するには、トップ画面を表示してください。</p>
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
} else {
    // 未認証
    // 移動
    header('Location: ../index.php');
    exit();
}
?>