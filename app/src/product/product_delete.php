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
  $pro_code = $_GET['procode'];
  // var_dump($pro_code);
  
  // DB接続
  $dsn = 'mysql:dbname=test_db;host=run-php-db;charset=utf8';
  $user = 'test';
  $password = 'test';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
  // スタッフ「コード」でstaffテーブルから1件のレーコードを取ってくる
  $sql = 'SELECT name,image FROM mst_product WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[]=$pro_code;
  $stmt->execute($data);
  // var_dump($stmt);
  
  $dbh = null;
  
  $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
  
  $pro_name=$rec['name'];
  $pro_image_name = $rec['image'];
  // var_dump($pro_image_name);
  
  if($pro_image_name=='')
  {
    $disp_gazou='';
  }
  else {
    $disp_gazou='<img src="./image/'.$pro_image_name.'">';
  }
  
  if(empty($pro_image_name) === true) {
    $disp_gazou = "";
  } else {
    $disp_gazou = "<img src='./image/".$pro_image_name."'>";
  }
  
} catch (\Throwable $th) {
  print'ただいま障害により大変ご迷惑をおかけしております。';
}
?>

商品削除 <br />
<br />
<!-- スタッフコードの表示 -->
商品コード<br />
<?php print $pro_code;?>
<br />
商品名<br />
<?php print $pro_name;?>
<br />
<br />
<?php print $disp_gazou;?>
<br />
この商品を削除してよろしいですか？<br />
<br />
<form method="post" action="product_delete_done.php">
<input type="hidden" name="code" value="<?php print $pro_code;?>">
<input type="hidden" name="image" value="<?php print $pro_image_name;?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>
