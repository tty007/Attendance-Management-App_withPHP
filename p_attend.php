<?php
  session_name('j160368t');
  session_start();
  $class_id = $_POST['cid'];
  $card_auto_id = $_POST['card_id'];
  $card_ip = $_POST['card_ip'];
  //授業取得
  $conn = pg_connect("host=localhost user=j160368t dbname=j160368t");
  $query = "select * from classes where auto_id=$1";
  $result = pg_prepare($conn, "detail", $query);
  $result = pg_execute($conn, "detail", array($class_id));
  $row = pg_fetch_assoc($result, 0);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>授業・出席確認ページ</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/classes.css">
  <link rel="stylesheet" href="css/attend.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
  <div class="center">
    <h2 class="class-name"><?php echo $row['name']; ?></h2>
    <p class="prof"><?php echo "教授：".$row['pname'] ?></p>
    <p class="class-content-title">授業内容</p>
    <p class="class-content-description-detail"><?php echo $row['content'] ?></p>
  </div>
  <div class="center">
    <?php
      $query = "select * from cards where auto_id=$1";
      $result = pg_prepare($conn, "carddetail", $query);
      $result = pg_execute($conn, "carddetail", array($card_auto_id));
      $row = pg_fetch_assoc($result, 0);
    ?>
    <p class="attend-card-name"><?php echo "出席カード名：".$row['title']; ?></p>
    <p class="attend-card-date"><?php echo "発行日時：".$row['pdate']; ?></p>
  </div>
  <div class="center">
    <?php
      $query = "select * from attends where card_id=$1 and ip=$2";
      $result = pg_prepare($conn, "attendconf", $query);
      $result = pg_execute($conn, "attendconf", array($card_auto_id, $card_ip));
      $num = pg_num_rows($result);
    ?>
    <h3>出席リスト</h3>
      <?php for ($i = 0; $i < $num; $i++) : ?>
        <?php $row = pg_fetch_assoc($result, $i); ?>
        <div class="sid">
          <?php echo "学籍番号：".$row['sid']; ?>
        </div>
        <div class="sdate">
          <?php echo "出席日時".$row['attend_date']; ?>
        </div>
      <?php endfor; ?>
  </div>
  <div class="center">
    <h3>この授業へのコメント</h3>
      <?php for ($i = 0; $i < $num; $i++) : ?>
        <?php $row = pg_fetch_assoc($result, $i); ?>
        <div class="comment">
          <?php echo $row['comment']; ?>
        </div>
      <?php endfor; ?>
  </div>

  <!-- ================================================= -->
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