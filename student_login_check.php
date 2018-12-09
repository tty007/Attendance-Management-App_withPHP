<?php
  //セッションの管理スタート
  session_name('j160368t');
  session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Checkログイン検証（生徒）</title>
  <link rel="stylesheet" href="css/reset.css">
</head>
<body>
  <?php
    $student_id = $_POST['student_id'];
    $student_pass = $_POST['student_pass'];

    $conn = pg_connect("host=localhost dbname=j160368t user=j160368t");
    //学籍番号に合致した生徒の情報を取得するクエリ文
    $query = "select * from students where id=$1";
    $result = pg_prepare($conn, "search", $query);
    $result = pg_execute($conn, "search", array($student_id));
    //合致したレコードの行数
    $rows = pg_num_rows($result);
    
    //合致したユーザが一人（一意）であれば成功
    if($rows==1){
      // レコードを連想配列として$rowに保存
      //1件だけを前提として変数に格納？（0の意味は？⇨0オリジンで１つ目の要素）
      $row = pg_fetch_assoc($result, 0);
      if(password_verify($student_pass, $row['password'])){
        //=====セッション変数にクレデンシャル情報を格納=====
        $_SESSION['sid'] = $student_id;
        $_SESSION['spass'] = $student_pass;
        $_SESSION['sname'] = $row['name'];
        $_SESSION['semail'] = $row['email'];
        $_SESSION['ssex'] = $row['sex'];
        print "{$row['name']}さん<br>ログイン成功<br>";
        print "<a href='index.php'>Topページへ</a>";
      } else {
        print "パスワードが間違っています<br>";
        print "<a href='student_login.php'>ログインページへ</a>";
      }
    } else {
      print "そのユーザは存在しません<br>";
      print "<a href=\"student_login.php\">ログインページへ</a>";
    }
  ?>
</body>
</html>