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
  // DB接続
  $dsn = 'mysql:dbname=test_db;host=run-php-db;charset=utf8';
  $user = 'test';
  $password = 'test';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
  $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
  $stmt = $dbh->prepare($sql);
  $stmt ->execute();
  
  $dbh = null;

  print'商品一覧<br />';
  
  print'<form method="post" action="product_branch.php">';
  // var_dump($stmt);
  while(true)
  {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec == false) {
      break;
    }
    // var_dump($rec);
    print'<input type="radio" name="procode" value="'.$rec['code'].'">';
    print $rec['name'] .' --- ';
    print $rec['price'] . '円';
    print'<br />';
  }
  
  print'<input type="submit" name="disp" value="参照 Reference">';
  print'<input type="submit" name="add" value="追加 Add">';
  print'<input type="submit" name="edit" value="修正 Edit">';
  print'<input type="submit" name="delete" value="削除 Delete">';
  print'</form>';
  
} catch (Exception $e) {
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}
?>

</body>
</html>