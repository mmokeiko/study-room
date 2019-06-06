<!--変数の定義-->
<?php
    //define('_ROOT_DIR', __DIR__ . '/');
    //require_once _ROOT_DIR . '../php_libs/init.php';
    require_once __DIR__ . '/../../php_libs/init.php';

    //----------------------------------------------------
    // URL/CSS/JSファイル関連
    //----------------------------------------------------
    //$rootURL = 'http://localhost/'; // rootURL
    $rootURL = '/study-room/index.php'; // rootURL
    //$fileCSS = 'http://localhost/master/study-room/htdocs/css/yotei.css';
    $fileCSS = '/study-room/css/yotei.css';
    //$fileJS = 'http://localhost/master/study-room/htdocs/js/yotei.js';
    $fileJS = '/study-room/js/yotei.js';
    
    
    //----------------------------------------------------
    // データベース関連 ini.phpを見に行くようにする為、コメントアウトする
    //----------------------------------------------------
    // データベース接続ユーザー名
    //define("_DB_USER", "schooluser");
    // データベース接続パスワード
    //define("_DB_PASS", "password");
    // データベースホスト名
    //define("_DB_HOST", "localhost");
    // データベース名
    //define("_DB_NAME", "school_jishu");
    // データベースの種類
    //define("_DB_TYPE", "mysql");
    // データソースネーム
    //define("_DSN", _DB_TYPE . ":host=" . _DB_HOST . ";dbname=" . _DB_NAME. ";charset=utf8");
    // テーブル名 5/1ここのデータベース名を変更
    $yotei_table = "school";
    
    //----------------------------------------------------
    // ログインパスワード関連
    //----------------------------------------------------
    // 管理者・ユーザともに、同じパスワードを使いまわしている簡易な設計になっています。
    //$admin_pass = "password";
    
    $fileTOP = '../index.php'; // トップ画面
    $fileADD = 'school_add.php'; // 予定を追加
    $fileEDIT = 'school_edit.php'; // 予定を変更
    $fileDEL = 'school_del.php'; // 予定を削除
    $myself = $_SERVER["PHP_SELF"];
	
    // ページのエンコーディング
    $page_enc = "UTF-8";

    // DB保存時のエンコーディング
    $db_enc = "UTF-8";
	
    // アプリケーション名
    $appli_name = "自習室予約システム";
	
    // タイトル名
    $title = "自習室予約システム";	
    
    //----------------------------------------------------
    // 文字列の長さ最大値チェック用
    //----------------------------------------------------    
    // コメントの文字列の最大文字数
    define("_COMMENT_LEN_MAX", 2000);
    
    //----------------------------------------------------
    // セレクタ用の連想配列
    //----------------------------------------------------
    
    // ①所属用の選択肢を配列で作る
    $shozoku_data = [
             '▼選択してください'=>'▼選択してください', //key=value
             'WEB'=>'WEB',
             'Network'=>'Network',
             'PG'=>'PG',
             'Office'=>'Office'
            ];
    
    // ②自習室用の選択股を配列で作る
    $room_data = [
             '▼選択してください'=>'▼選択してください', //key=value
             'jishu_A'=>'自習室A',
             'jishu_B'=>'自習室B',
             'jishu_C'=>'自習室C',
             'jishu_D'=>'自習室D'
            ];
    
?>