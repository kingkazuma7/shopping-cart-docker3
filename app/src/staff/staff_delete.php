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
  // 選択されたスタッフ「コード」を受け取る
  $staff_code = isset($_GET['staffcode']) ? $_GET['staffcode'] : null;
  
  // DB接続
  $dsn = 'mysql:dbname=test_db;host=run-php-db;charset=utf8';
  $user = 'test';
  $password = 'test';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
  // スタッフ「コード」でstaffテーブルから1件のレーコードを取ってくる
  $sql = 'DELETE FROM mst_staff WHERE code=?';
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

<!-- 登録されているスタッフのデータを削除する画面 -->

スタッフ削除 <br />
Delete Staff<br />
<br />
<!-- スタッフコードの表示 -->
スタッフコード<br />
Staff #<br />
<?php print $staff_code;?>
<br />
スタッフ名<br />
<?php print $staff_name;?>
<br />
<br />
このスタッフを削除してよろしいですか？<br />
Are you sure you want to delete this staff?<br />
<br />

<form method="post" action="staff_delete_done.php">
<input type="hidden" name="code" value="<?php print $staff_code;?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>