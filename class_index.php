<?php
  session_name('j160368t');
  session_start();
  $class_id = $_GET['auto_id'];
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
  <title>授業詳細ページ</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/classes.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
  <div class="center">
    <h2 class="class-name"><?php echo $row['name']; ?></h2>
    <p class="prof"><?php echo "教授：".$row['pname'] ?></p>
    <p class="class-content-title">授業内容</p>
    <p class="class-content-description-detail"><?php echo $row['content'] ?></p>

    <!-- ボタン群 -->
    <?php if (isset($_SESSION['pid'])) : ?>
      <?php if ($_SESSION['pname'] == $row['pname']) : ?>
        <form method="POST" action="delete_class.php">
          <input type="hidden" name="cid" value="<?php echo $class_id; ?>">
          <input type="submit" class="to-class-index" value="授業を削除する">
        </form>
        <form method="POST" action="make_card.php">
          <input type="hidden" name="cid" value="<?php echo $class_id; ?>">
          <input type="submit" class="to-class-index" value="出席カードを作成する">
        </form>
      <?php endif; ?>
    <?php endif; ?>
  </div>

  <!-- 出席カード表示 -->
  <?php
    $query1 = "select * from cards where cid=$1";
    $result = pg_prepare($conn, "cards", $query1);
    $result = pg_execute($conn, "cards", array($class_id));
    $num =pg_num_rows($result);
    //出席確認クエリ
    $query2 = "select * from attends where card_id=$1 and sid=$2";
  ?>

  <div class="center">
  <?php for ($i = 0; $i < $num; $i++) : ?>
    <?php $row = pg_fetch_assoc($result, $i); ?>
    <div class="attend-card">
      <h3><?php echo $row['title'] ?></h3>
      <!-- ボタン遷移 -->
      <?php
      //生徒のみの処理
        if (isset($_SESSION['sid'])) {
          $card_id = $row['auto_id'];
          $sid = $_SESSION['sid'];
          //prepareのあとにexecuteせずに同名でprepareしたらエラーが出る
          //無名ステートメントで上書き
          $result2 = pg_prepare($conn, "", $query2);
          $result2 = pg_execute($conn, "", array($card_id, $sid));
          $num2 =pg_num_rows($result2);
        }
      ?>
      <?php if (isset($_SESSION['sid'])) : ?>
        <?php if ($num2 == 1) : ?>
          <div class="center">
            <p>すでに出席しています</p>
          </div>
        <? else : ?>
          <!-- 出席していなければ -->
          <div class="center">
          <form method="POST" action="attend.php">
            <input type="hidden" name="cid" value="<?php echo $class_id; ?>">
            <input type="hidden" name="card_id" value="<?php echo $row['auto_id']; ?>">
            <input type="submit" class="to-attend" value="出席申請">
          </form>
          </div>
        <? endif; ?>
      <?php endif; ?>

      <!-- 教授用ボタン -->
      <?php if (isset($_SESSION['pid'])) : ?>
      <div class="center">
          <form method="POST" action="p_attend.php">
            <input type="hidden" name="cid" value="<?php echo $class_id; ?>">
            <input type="hidden" name="card_id" value="<?php echo $row['auto_id']; ?>">
            <input type="hidden" name="card_ip" value="<?php echo $row['ip']; ?>">
            <input type="submit" class="to-attend" value="授業管理">
          </form>
          </div>
      <?php endif; ?>
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