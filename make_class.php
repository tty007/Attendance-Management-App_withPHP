<?php
  session_name('j160368t');
  session_start();
  $pname = $_SESSION['pname'];
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
  <title>授業作成</title>
</head>
<body>
  <?php if (isset($_SESSION['pid'])): ?>
  <!-- ログイン時教授であれば -->
    <div class="form-wrapper center">
      <img src="images/webapp_logo.png" class="form-image">
      <form method="POST" action="./make_class_check.php">
          <label>
            <p>授業名</p>
            <input type="text" name="name" required>
          </label>
          <label>
            <p>授業内容</p>
            <textarea name="content" rows="10" cols="40">内容を記入します</textarea>
          </label>
          <label>
            <input type="hidden" name="pname" value="<?= $pname; ?>">
          </label>
          <input type="submit" value="授業を登録する" class="main_button">
        </form>
    </div>
    <!-- ここに教授メニュー -->
    <nav class="footer-nav">
      <ul>
        <li><a href="index.php"><i class="fas fa-home"></i></a></li>
        <li><a href="make_class.php"><i class="fas fa-pen-nib"></i></a></li>
        <li><a href="classes.php"><i class="fas fa-align-justify"></i></a></li>
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