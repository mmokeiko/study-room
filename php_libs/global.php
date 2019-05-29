<?php

// ログイン認証をチェックする関数。
function checkLogin() {
    $flag = false;
    // セッション開始　認証に利用します。
    $auth = new Auth(); //
    $auth->set_authname(_MEMBER_AUTHINFO);
    $auth->set_sessname(_MEMBER_SESSNAME);
    $auth->start();
     if ($auth->check()) {
         $flag = true;
     } else {
         $flag = false;
     }
     return $flag;
}
//MenberController.phpの27行目あたりの記載を参照
//testauth2.phpを参考にしても良い。
//コードの記載方法が違う
//Authクラスのインスタンスを定義して、thisの代わりに必要な処理
//start関数、check関数で判定でログインかどうか
?>
