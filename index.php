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
  <title>Check</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/nicomoji.css">
</head>
<body>
  <!-- ナビゲーションメニュー -->
  <nav>
    <ul class="nav-items">
      <?php if(isset($_SESSION['sid'])): ?>
        <!-- <li class="nav-button"><a href="student_mypage.php">マイページ</a></li> -->
        <li class="nav-button"><a href="logout.php">ログアウト</a></li>
      <?php elseif(isset($_SESSION['pid'])): ?>
        <!-- <li class="nav-button"><a href="#">生徒管理</a></li> -->
        <li class="nav-button"><a href="logout.php">ログアウト</a></li>
      <?php else: ?>
        <li class="nav-button"><a href="./student_regist.php">学生はこちら</a></li>
        <li class="nav-button"><a href="./professor_regist.php">教授はこちら</a></li>
      <?php endif; ?>
    </ul>
  </nav>
  <!-- 本体 -->
  <div class="top-images-wrapper">
    <img src="images/top.jpg" class="top-image">
    <img src="images/webapp_logo.png" class="top-sub-image">
    <p>
      は、確実に出席を管理するためのプラットフォームです。
    </p>
  </div>
  <section class="about-service center">
    <h2>ABOUT SERVICE</h2>
    <div class="card">
      <div class="card-icon">
        <i class="fas fa-chalkboard-teacher"></i>
      </div>
      <p>
        出席をIPアドレスで管理。生徒が講義に来ていないことが一目瞭然で判別できます。
      </p>
    </div>
    <div class="card">
      <div class="card-icon">
      <i class="fas fa-mobile-alt"></i>
      </div>
      <p>
        モバイルファーストなUIを採用。スマホでもシンプルなデザインで使用できます。レスポンシブデザインに対応済み。
      </p>
    </div>
    <div class="card">
      <div class="card-icon">
          <i class="far fa-comment-alt"></i>
      </div>
      <p>
        生徒は毎回の授業にコメントを匿名で投稿可能。教授は生徒から授業のフィードバックを得ることができます。
      </p>
    </div>
  <!-- UIについて -->
  </section>
  <section class="about-ui center">
    <h2>ABOUT UI</h2>
    <div class="features ui">
      <img src="./images/list-ui.png" alt="シンプルUI">
      <p>使いやすさを重視した、モバイルファーストUI</p>
    </div>
    <div class="features-tile">
      <div class="features tile-contents tile-1">
        <img src="./images/simple-ui.png" alt="授業一覧　シンプルUI">
        <p>授業一覧ではカードレイアウトを用い、洗練されたシンプルなUIを実現</p>
      </div>
      <div class="features tile-contents tile-2">
        <img src="./images/simple-ui2.png" alt="出席申請　シンプルUI">
        <p>ストレスなく、とにかく簡単に出席申請ができる</p>
      </div>
      <div class="features tile-contents tile-3">
        <img src="./images/attend-look.png" alt="教授　出席管理画面　シンプルUI">
        <p>無駄な配色を使わない、シンプルな出席管理。出席した日付と異なるIPアドレスからの出席を不可にすることで厳格な出席管理が実現。</p>
      </div>
      <div class="features tile-contents tile-4">
        <img src="./images/comment.png" alt="匿名コメント">
        <p>教授は毎授業ごとに生徒からの匿名コメントでフィードバックを得ることが可能。次の授業を改善できる。</p>
      </div>
    </div>
  </section>
  <!-- フッター -->
  <footer>
    <p>©️Check-チェック：出欠管理プラットフォーム-</p>
  </footer>
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