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
    <title>出席申請検証ページ</title>
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
    $comment = $_POST['comment'];
    $card_cid = $_POST['cid'];
    $card_id = $_POST['card_id'];
    $attend_time = $_POST['attend_date'];
    $attend_ip = $_POST['ip'];
    $sid = $_POST['sid'];

    $conn = pg_connect("host=localhost dbname=j160368t user=j160368t");
    $query = "insert into attends (card_id, attend_date, ip, sid, comment) values ($1, $2, $3, $4, $5)";
    $result = pg_prepare($conn, 'regist', $query);
    $result = pg_execute($conn, 'regist', array($card_id, $attend_time, $attend_ip, $sid, $comment));
  ?>
  <!-- ここにエラーがなかった時のHTML -->
  <div class="center done-script">
  <img src="images/webapp_logo.png" class="form-image done-image center">
    <p>出席申請が完了しました</p>
  </div>
  <div class="center">
    <button class="main_button">
      <a href="class_index.php?auto_id=<?php echo $card_cid; ?>">
        <p>授業詳細ページへ</p>
      </a>
    </button>
  </div>
  <?php endif; ?>
  <!-- フッターナビゲーション -->
  <?php if(isset($_SESSION['sid'])): ?>
    <!-- ここに生徒メニュー -->
    <nav class="footer-nav">
      <ul>
        <li><a href="index.php"><i class="fas fa-home"></i></a></li>
        <li><a href="classes.php"><i class="fas fa-align-left"></i></a></li>
        <li><i class="fas fa-search"></i></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
      </ul>
    </nav>
  <?php endif; ?>
  <?php if(isset($_SESSION['pid'])): ?>
    <!-- ここに教授メニュー -->
    <nav class="footer-nav">
      <ul>
        <li><a href="index.php"><i class="fas fa-home"></i></a></li>
        <li><a href="make_class.php"><i class="fas fa-pen-nib"></i></a></li>
        <li><a href="classes.php"><i class="fas fa-align-justify"></i></a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
      </ul>
    </nav>
  <?php endif; ?>
  </body>
</html>