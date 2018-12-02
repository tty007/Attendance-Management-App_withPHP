<?php
	session_name('j160368t');
  session_start();
  $conn = pg_connect("host=localhost user=j160368t dbname=j160368t");
  $query = "SELECT * FROM classes";
	$result = pg_prepare($conn, "list", $query);
  $result = pg_execute($conn, "list", array());
  $num =pg_num_rows($result);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>講義一覧ページ</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/classes.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
  <div class="center">
    <h1>授業一覧</h1>
    <?php for ($i = 0; $i < $num; $i++) : ?>
    <!-- for文の中身 -->
      <?php $row = pg_fetch_assoc($result, $i); ?>
      <div class="center card">
        <h2><?php echo $row['name'] ?></h2>
        <p class="prof"><?php echo "教授：".$row['pname'] ?></p>
        <p class="class-content-title">授業内容</p>
        <p class="class-content-description"><?php echo $row['content'] ?></p>
        <?php if (isset($_SESSION['pid'])) : ?>
          <?php if ($_SESSION['pname'] == $row['pname']) : ?>
            <button class="to-class-index"><a href="class_index.php?auto_id=<?php echo $row['auto_id'] ?>">授業を編集する</a></button>
          <?php endif; ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['sid'])) : ?>
          <button class="to-class-index"><a href="class_index.php?auto_id=<?php echo $row['auto_id'] ?>">授業詳細</a></button>
        <?php endif; ?>
      </div>
    <!-- for文の中身終了 -->
    <?php endfor; ?>
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