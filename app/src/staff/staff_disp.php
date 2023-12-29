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
  $staff_code = isset($_GET['staffcode']) ? $_GET['staffcode'] : null;
  
  // DB接続
  $dsn = 'mysql:dbname=test_db;host=run-php-db;charset=utf8';
  $user = 'test';
  $password = 'test';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
  // スタッフ「コード」でstaffテーブルから1件のレーコードを取ってくる
  $sql = 'SELECT name FROM mst_staff WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[]=$staff_code;
  $stmt->execute($data);
  
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $staff_name = isset($rec['name']) ? $rec['name'] : null;
  
  $dbh = null;
}
catch(Exception $e)
{
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}
?>

<h4>スタッフ情報参照</h4>
<h5>スタッフコード</h5>
<?php print $staff_code;?>
<h5>スタッフ名</h5>
<?php print $staff_name;?>

<br />
<br />
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>

</body>
</html>
