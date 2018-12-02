<?php
	session_name("j160368t");
	session_start();
  $conn = pg_connect("host=localhost user=j160368t dbname=j160368t");
  $cid = $_POST['cid'];
  $pname = $_SESSION['pname'];
  $query = "DELETE FROM classes WHERE auto_id = $1 and pname = $2";
  $result = pg_prepare($conn, "delete", $query);
  $result = pg_execute($conn, "delete", array($cid, $pname));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>授業削除</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/classes.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
  <div class="center">
    <p class="delete-description">授業が削除されました。</p>
  </div>
  <div class="center">
  <button class="to-class-index"><a href="index.php">トップへ戻る</a></button>
  </div>
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