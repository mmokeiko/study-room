<?php
define('_ROOT_DIR', __DIR__ . '/');
require_once _ROOT_DIR . '../php_libs/init.php';
//init.phpの中にglobal.phpも読み込み出来るようにする

if (checkLogin()) {
    // 認証済み
    //認証したらここに認証後の画面を記載する、または別の画面へ読み込みを指定する
    print 'テスト01画面：認証済み'.'<br>';
    print '<a href="./test02.php">テスト02画面</a><br>';
    print '<a href="./index.php">会員トップ画面</a><br>';
} else {
    // 未認証
    //print '未認証'.'<br>';
    //print '<a href="./index.php">ログイン画面</a><br>';
    // 移動
    header('Location: index.php');
    exit();
}
    
?>