<?php
  session_name('j160368t');
  session_start();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check登録検証ページ</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/form.css">
  </head>
  <body>
  <?php
    require_once("./lib/util.php");
    //文字エンコードの検証
    if (!cken($_POST)) {
      //内部文字エンコーディングを取得
      $encoding = mb_internal_encoding();
      $err = "エンコードエラーです。適応エンコードは".$encoding."です。";
      //エラーメッセージを出して以下のコードを全てキャンセル
      exit($err);
    }
    //HTMLエスケープ
    $_POST = es($_POST);
    //エラーメッセージを格納するファイル準備
    $errors = [];
  ?>
  <!-- 判定処理 -->
  <?php
    if (!isset($_POST['student_id'])) {
      $id = $_POST['student_id'];
      //整数チェック
      if (!ctype_digit($id)) {
        $errors = "学籍番号を整数で記入してください。";
      }
    }
    if (!isset($_POST['student_name'])) {
      $errors = "名前を記入してください。";
    }
    if (!isset($_POST['student_email'])) {
      $errors = "メールアドレスを記入してください。";
    }
    if (!isset($_POST['sex'])) {
      $errors = "性別を記入してください。";
    }
    if (!isset($_POST['student_pass'])) {
      $errors = "パスワードを記入してください。";
    }
  ?>
  <!-- 判定分岐 -->
  <?php if (count($errors) > 0): ?>
  <?php
    echo '<ol class="error-items">';
    foreach ($errors as $value) {
      echo '<li class="error-item">', $value, '</li>';
    }
    echo '</ol>';
  ?>
  <!-- ここにエラーがあった時のHTML -->
  <p>正常に登録処理がなされませんでした</p>
  <?php else: ?>
  <?php
    //エラーがなかった時
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $student_email = $_POST['student_email'];
    $sex = $_POST['sex'];
    $pwd = password_hash($_POST['student_pass'], PASSWORD_DEFAULT);

    $conn = pg_connect("host=localhost dbname=j160368t user=j160368t");
    $query = "insert into students (id, name, email, sex, password) values ($1, $2, $3, $4, $5)";
    $result = pg_prepare($conn, 'sregist', $query);
    $result = pg_execute($conn, 'sregist', array($student_id, $student_name, $student_email, $sex, $pwd));
  ?>
  <!-- ここにエラーがなかった時のHTML -->
  <div class="center done-script">
  <img src="images/webapp_logo.png" class="form-image done-image center">
    <p>正常に登録されました!</p>
  </div>
  <div class="center">
    <button class="main_button">
      <a href="student_login.php">
        <p>ログインページへ</p>
      </a>
    </button>
  </div>
  <?php endif; ?>
  </body>
</html>