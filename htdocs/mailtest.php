

<?php
 
// メール情報
$mailto = "program.enji@gmail.com"; // 宛先のメールアドレス
$subject = "件名";
$content = "本文";
$mailfrom = "From:info@mmokeiko.com"; // From:送信元のメールアドレス(サーバパネルで設定したやつ)
 
// 文字化けするようなら下記のコメントアウト解除してみて
// mb_language("ja");
mb_internal_encoding("UTF-8");
 
// メール送信処理
$result = mb_send_mail($mailto,$subject,$content,$mailfrom);
 
// メール送信処理結果出力
if($result){
	echo "送信成功";
}else{
	echo "送信失敗";
}

