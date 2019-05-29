<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
</head>
<body>
<div style="text-align:center;
     ">
<hr>
<strong>{$title}</strong>
<hr>
    <table style="margin: 0 auto;">
        	
      <tr>
      <td style="vertical-align:top;">
                 
                 
            [ <a href="{$SCRIPT_NAME}?type=logout">ログアウト</a> ]
	<br>
	<br>
	{$disp_login_state}

      </td>
        <td style="vertical-align:top;">
        <div style="text-align: left; margin-left:15px;">
          {$last_name|escape:"html"} {$first_name|escape:"html"} さん、こんにちは！
          <br>
          <!-- ログイン認証チェック付き画面遷移のテスト -->
          <br>
	        <a href="school_yotei/school_add.php">自習室予約を追加する</a>
          <br>
          <br>
	        <a href="school_yotei/school_edit.php">自習室予約を変更する</a>
          <br>
          <br>
	        <a href="school_yotei/school_del.php">自習室予約を削除する</a>
          <br>  
          <br>
	        <a href="{$SCRIPT_NAME}?type=modify&action=form">会員登録情報の修正</a>
          <br>
          <br>
	        <a href="{$SCRIPT_NAME}?type=delete&action=confirm">退会する</a>
          <br>

        </div>
        </td>
      </tr>
    </table>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
<!--Googleアナリティクスのコードをここに入れる-->
</body>
</html>
