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

<!-- スタッフコードの表示 -->
スタッフコード<br />
<?php print $staff_code ?>
<br>
<br>
<form method="post" action="staff_edit_check.php">
<input type="hidden" name="code" value="<?php print $staff_code ?>">
スタッフ名 <br />
<input type="text" name="name" value="<?php print $staff_name; ?>"><br />
パスワードを入力してください。<br />
<input type="password" name="pass" style="width:100px"><br />
パスワードをもう一度入力してください。<br />
<input type="password" name="pass2" style="width:100px"><br />
<br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</body>
</html>