<?php
  session_name('j160368t');
  session_start();
  $sname = $_SESSION['sname'];
  $sid = $_SESSION['sid'];
  $cid = $_POST['cid'];
  $card_id = $_POST['card_id'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/form.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/nicomoji.css">
  <title>出席申請ページ</title>
</head>
<body>
  <?php if (isset($_SESSION['sid'])): ?>
  <!-- ログイン時生徒であれば -->
    <div class="form-wrapper center">
      <img src="images/webapp_logo.png" class="form-image">
      <form method="POST" action="./attend_check.php">
        <label>
        <p>今回の授業に関するコメント</p>
        <textarea name="comment" class="class-comment" required></textarea>
        </label>
        <!-- 授業id -->
        <input type="hidden" name="cid" value="<?= $cid; ?>">
        <!-- カードid -->
        <input type="hidden" name="card_id" value="<?= $card_id; ?>">
        <!-- 日付 -->
        <input type="hidden" name="attend_date" value="<?php echo date("Y/m/d H:i:s"); ?>">
        <!-- IPアドレス -->
        <input type="hidden" name="ip" value="<?php echo $_SERVER["REMOTE_ADDR"]; ?>">
        <!-- 学籍番号 -->
        <input type="hidden" name="sid" value="<?php echo $sid; ?>">
        <input type="submit" value="出席カードを登録する" class="main_button">
      </form>
    </div>
    <!-- ここに生徒メニュー -->
    <nav class="footer-nav">
      <ul>
        <li><a href="index.php"><i class="fas fa-home"></i></a></li>
        <li><a href="classes.php"><i class="fas fa-align-left"></i></a></li>
        <li><i class="fas fa-search"></i></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
      </ul>
    </nav>
  <?php else: ?>
  <!-- それ以外のエラーページ表示 -->
  <div class="center">
    <p>許可されていないユーザ、または不正なページ遷移です。</p>
  </div>
  <?php endif; ?>
</body>
</html>