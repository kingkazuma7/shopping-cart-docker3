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
  // 選択されたスタッフ「コード」を受け取る
  $pro_code = isset($_GET['procode']) ? $_GET['procode'] : null;
  
  // DB接続
  $dsn = 'mysql:dbname=test_db;host=run-php-db;charset=utf8';
  $user = 'test';
  $password = 'test';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
  // スタッフ「コード」でproductテーブルから1件のレーコードを取ってくる
  $sql = 'SELECT name,price,image FROM mst_product WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $pro_code;
  $stmt->execute($data);
  
  $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
  // var_dump($rec);
  $pro_name = $rec['name'];
  $pro_price = $rec['price'];
  $pro_gazou_name_old = $rec['image'];
  
  $dbh = null;
  
  if($pro_gazou_name_old=='')
  {
    $disp_gazou='';
  }
  else
  {
    $disp_gazou='<img src="./image/'.$pro_gazou_name_old.'">';
  }
  
}

catch(Exception $e)
{
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}
?>

<!-- 商品コードの表示 -->
<!-- あらかじめテキストボックスにデフォルト値として、商品名を入れておく -->
<form method="post" action="product_edit_check.php" enctype="multipart/form-data">
商品名 <br />
<input type="text" name="name" style="width:200px" value="<?php print $pro_name;?>"><br />
価格<br />
<input type="text" name="price" style="width:50px" value="<?php print $pro_price;?>">円<br />
<br />
<?php print $pro_gazou_name_old;?>
<br />
画像を選んでください。<br />
<input type="file" name="image" style="width:400px"><br />
<br />
<input type="hidden" name="code" value="<?php print $pro_code ?>">
<input type="hidden" name="old_image" value="<?php print $pro_gazou_name_old; ?>">
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</body>
</html>