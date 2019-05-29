<?php
define('_ROOT_DIR', __DIR__ . '/');
require_once _ROOT_DIR . '../php_libs/init.php';

if (checkLogin()) {
    // 認証済み
    print 'テスト02画面：認証済み'.'<br>';
    print '<a href="./test01.php">テスト01画面</a><br>';
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