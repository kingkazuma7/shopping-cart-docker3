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
  
  // スタッフ「コード」でstaffテーブルから1件のレーコードを取ってくる
  $sql = 'SELECT name,price,image FROM mst_product WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $pro_code;
  // var_dump($data[]);
  $stmt->execute($data);
  
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $pro_name = $rec['name'];
  $pro_price = $rec['price'];
  $pro_gazou_name = $rec['image'];
  
  $dbh = null;
  
  if($pro_gazou_name=='')
  {
    $disp_gazou = '';
  }
  else
  {
    $disp_gazou = '<img src="./image/'.$pro_gazou_name.'">';
  }

  }
  catch(Exception $e)
  {
    print'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
  }
?>

商品情報参照<br />
<br />
<!-- 商品コードの表示 -->
商品コード<br />
<?php print $pro_code;?>
<br />
商品名<br />
<?php print $pro_name;?>
<br />
価格<br />
<?php print $pro_price;?>円
<br />
<?php print $disp_gazou; ?>
<br />
<br />

<form>
<input type="button" onclick="history.back()" value="戻る">
</form>

</body>
</html>
