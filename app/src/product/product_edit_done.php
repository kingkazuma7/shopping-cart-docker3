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
  $product_code=$_POST['code'];
  $product_name=$_POST['name'];
  $product_price=$_POST['price'];
  $old_image=$_POST['old_image']; // 古い画像(前のname)
  $product_image=$_POST["image"]; // 新しい画像
  
  $pro_code = htmlspecialchars($product_code,ENT_QUOTES,'UTF-8');
  $pro_name = htmlspecialchars($product_name,ENT_QUOTES,'UTF-8');
  $pro_price = htmlspecialchars($product_price,ENT_QUOTES,'UTF-8');
  
  // DB接続
  $dsn = 'mysql:dbname=test_db;host=run-php-db;charset=utf8';
  $user = 'test';
  $password = 'test';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
  // DB操作
  $sql = 'UPDATE mst_product SET name=?,price=?,image=? WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $pro_name;
  $data[] = $pro_price;
  $data[] = $product_image;
  $data[] = $pro_code;
  $stmt->execute($data);

  $dbh = null;
  
  // 古い画像を削除
  // $product_imageは新しくアップロードされた画像の名前。これらの二つの変数が異なる場合、つまり新しい画像がアップロードされた場合かつ
  if ($old_image != $product_image) {
    if ($old_image != '') { // 元の画像が空じゃなかったら
      unlink('./image/'.$old_image);
    }
  }
  
  print $pro_name;
  print'修正しました。<br />';
  
} catch(Exception $e) {
    print'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}

?>

<a href="product_list.php">戻る</a>

</body>
</html>
