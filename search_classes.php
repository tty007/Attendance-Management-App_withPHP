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
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/form.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/nicomoji.css">
  <title>授業検索画面</title>
</head>
<body>
    <div class="form-wrapper center">
      <img src="images/webapp_logo.png" class="form-image">
      <form method="GET" action="./search_result.php">
        <label>
          <p>授業名キーワード</p>
          <input type="text" name="keyword" required>
        </label>
        <input type="submit" value="検索する" class="main_button">
      </form>
    </div>
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