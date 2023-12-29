<?php
session_start();

try {
  $staff_code=$_POST['code'];
  $staff_pass=$_POST['pass'];
  $staff_code= htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');
  $staff_pass= htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');
  
  $staff_pass=md5($staff_pass);
  
  // DB接続
  $dsn = 'mysql:dbname=test_db;host=run-php-db;charset=utf8';
  $user = 'test';
  $password = 'test';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $sql = 'SELECT name FROM mst_staff WHERE code=? AND password=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_code;
  $data[] = $staff_pass;
  $stmt->execute($data);
  
  $dbh = null;
  
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  // var_dump($rec);
  if ($rec == false) {
    print'スタッフコードかパスワードが間違っています。<br />'; 
    print'<a href="staff_login.html">戻る</a>';
  } else {
    $_SESSION['login'] = 1;
    $_SESSION['staff_code'] = $staff_code;
    $_SESSION['staff_name'] = $rec['name'];
    header('Location:staff_top.php');
    // var_dump($_SESSION['staff_name']);
    exit;
  }
  
} catch (\Throwable $e) {
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}
?>