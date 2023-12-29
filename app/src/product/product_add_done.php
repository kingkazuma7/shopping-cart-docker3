<?php
require_once dirname(__FILE__) . '/../common/common.php';
start_session_and_check_login(); // login
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
  // すたっふ名とパスワードを受け取る
  $post=sanitize($_POST);
  $product_name = $post['name'];
  $staff_price = $post['price'];
  // $product_image = isset($_FILES['image']) ? $_FILES['image'] : null;
  // $product_image = isset($_FILES['image']) ? $_FILES['image']['tmp_name'] : null;
  $product_image = $post["image"];
  // var_dump($product_image);


  // DB接続
  $dsn = 'mysql:dbname=test_db;host=run-php-db;charset=utf8';
  $user = 'test';
  $password = 'test';
  $dbh = new PDO($dsn, $user, $password);
  
  $sql = 'INSERT INTO mst_product(name,price,image) VALUES (?,?,?)';
  $stmt = $dbh->prepare($sql);
  
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $data[] = $product_name;
  $data[] = $staff_price;
  $data[] = $product_image;
  $stmt->execute($data);
  
  // DB切断
  $dbh = null;
  
  print $product_name;
  print'を追加しました。<br />';
  
} catch(Exception $e) {
  print_r($stmt->errorInfo());
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}
?>

<a href="product_list.php">戻る</a>

</body>
</html>
