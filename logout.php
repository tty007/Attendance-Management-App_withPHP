<?php
	session_name('j160368t');
	session_start();
  $_SESSION = array();
  //sessioncookieの削除
  $params = session_get_cookie_params();
  setcookie(session_name(), '', time() - 3600, $params['path']);
	session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="Content-type" content="text/html;charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
  <title>ログアウトページ</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/logout.css">
</head>
<body>
  <div class="center">
    <img src="images/webapp_logo.png" class="form-image">
    <div class="center">
      <p>ログアウトしました。</p>
      <button class="main_button"><a href="index.php">TOPへ</a></button>
    </div>
  </div>
</body>
</html>