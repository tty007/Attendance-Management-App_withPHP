<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Checkログイン（生徒）</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/form.css">
	</head>
	<body>
    <div class="form-wrapper center">
      <img src="images/webapp_logo.png" class="form-image">
      <form method="POST" action="./student_login_check.php">
        <label>
          <p>学籍番号</p>
          <input type="number" name="student_id" required>
        </label>
        <label>
          <p>パスワード</p>
          <input type="password" name="student_pass" required>
        </label>
        <input type="submit" value="ログインする" class="main_button">
      </form>
    </div>
    <div class="to_other">
      <a href="student_regist.php">
        <p>新規登録はこちら</p>
      </a>
    </div>
    <div class="to_home">
      <a href="index.php">
        <p>ホーム</p>
      </a>
    </div>
	</body>
</html>