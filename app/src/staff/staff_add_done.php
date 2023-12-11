<?php
session_start();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Yashy農園</title>
</head>
<body>
<?php

try {
  require_once dirname(__FILE__) . '/../common/common.php';
  
  // すたっふ名とパスワードを受け取る
  $post=sanitize($_POST);
  $staff_name = $post['name'];
  $staff_pass = $post['pass'];
  
  // DB接続
  $dsn = 'mysql:dbname=test_db;host=run-php-db;';
  $user = 'test';
  $password = 'test';
  $dbh = new PDO($dsn, $user, $password);
  
  $sql = 'INSERT INTO users(name,password) VALUES (?,?)';
  $stmt = $dbh->prepare($sql);
  
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $data[] = $staff_name;
  $data[] = $staff_pass;
  $stmt->execute($data);
  
  // DB切断
  $dbh = null;
  
  print $staff_name;
  print'さんを追加しました。<br />';
  print $staff_name;
  print' is add.<br />';
  
} catch(Exception $e) {
  print_r($stmt->errorInfo());
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}
?>

<a href="staff_list.php">戻る</a>

</body>
</html>