<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Check会員登録（生徒）</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/form.css">
	</head>
	<body>
    <div class="form-wrapper center">
      <img src="images/webapp_logo.png" class="form-image">
      <form method="POST" action="./student_regist_check.php">
        <label>
          <p>学籍番号</p>
          <input type="number" name="student_id" required>
        </label>
        <label>
          <p>名前</p>
          <input type="text" name="student_name" required>
        </label>
        <label>
          <p>メールアドレス</p>
          <input type="email" name="student_email" pettern="^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required>
        </label>
        <div class="sex-wrapper">
          <p>性別</p>
          <input type="radio" name="sex" value="1" /> 男　<input type="radio" name="sex" value="2" /> 女
        </div>
        <label>
          <p>パスワード</p>
          <input type="password" name="student_pass" required>
        </label>
        <input type="submit" value="新規会員登録する" class="main_button">
      </form>
    </div>
    <div class="to_other">
      <a href="student_login.php">
        <p>ログインはこちら</p>
      </a>
    </div>
    <div class="to_home">
      <a href="index.php">
        <p>ホーム</p>
      </a>
    </div>
	</body>
</html>