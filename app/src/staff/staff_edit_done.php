<?php
require_once dirname(__FILE__) . '/../common/common.php';
session_login(); // login
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
  $staff_code = $post['code'];
  $staff_name = $post['name'];
  $staff_pass = $post['pass'];
  
  // DB接続
  $dsn = 'mysql:dbname=test_db;host=run-php-db;charset=utf8';
  $user = 'test';
  $password = 'test';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql = 'UPDATE mst_staff SET name=?,password=? WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_name;
  $data[] = $staff_pass;
  $data[] = $staff_code;
  $stmt->execute($data);
  
  // DB切断
  $dbh = null;
  
} catch(Exception $e) {
  print_r($stmt->errorInfo());
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}
?>

修正しました。<br />
Compleate.
<a href="staff_list.php">戻る</a>

</body>
</html>