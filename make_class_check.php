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
    <title>授業登録検証ページ</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/nicomoji.css">
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
    if (!isset($_POST['name'])) {
      $errors = "授業名を記入してください。";
    }
    if (!isset($_POST['content'])) {
      $errors = "内容を記入してください。";
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
  <div class="center">
    <img src="images/webapp_logo.png" class="form-image done-image center">
    <p>正常に登録処理がなされませんでした</p>
  </div>
  <?php else: ?>
  <?php
    //エラーがなかった時
    $class_name = $_POST['name'];
    $class_content = $_POST['content'];
    $class_professor = $_POST['pname'];

    $conn = pg_connect("host=localhost dbname=j160368t user=j160368t");
    $query = "insert into classes (name, content, pname) values ($1, $2, $3)";
    $result = pg_prepare($conn, 'sregist', $query);
    $result = pg_execute($conn, 'sregist', array($class_name, $class_content, $class_professor));
  ?>
  <!-- ここにエラーがなかった時のHTML -->
  <div class="center done-script">
  <img src="images/webapp_logo.png" class="form-image done-image center">
    <p>授業は正常に登録されました</p>
  </div>
  <div class="center">
    <button class="main_button">
      <a href="classes.php">
        <p>授業一覧ページへ</p>
      </a>
    </button>
  </div>
  <div class="center">
    <button class="main_button">
      <a href="make_class.php">
        <p>続けて授業を作成する</p>
      </a>
    </button>
  </div>
  <!-- ここに教授メニュー -->
  <nav class="footer-nav">
    <ul>
      <li><a href="make_class.php"><i class="fas fa-pen-nib"></i></a></li>
      <li><i class="fas fa-align-justify"></i></li>
    </ul>
  </nav>
  <?php endif; ?>
  </body>
</html>