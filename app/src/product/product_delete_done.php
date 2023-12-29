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
require_once dirname(__FILE__) . '/../common/common.php';
$post = sanitize($_POST);
// var_dump($post);
$code = $post["code"];
$pro_image_name = $post["image"];

// 画像が登録されていれば保存先のimageからも削除
if (empty($pro_image_name) === false) {
  unlink("./image/".$pro_image_name);
}

// DB接続
$dsn = 'mysql:dbname=test_db;host=run-php-db;charset=utf8';
$user = 'test';
$password = 'test';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'DELETE FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[]=$code;
$stmt->execute($data);
// var_dump($stmt);

$dbh = null;

if($pro_image_name=='')
{
  $disp_gazou='';
}
else {
  $disp_gazou='<img src="./image/'.$pro_image_name.'">';
}

} catch (\Throwable $th) {
print'ただいま障害により大変ご迷惑をおかけしております。';
}
?>

削除しました。<br />
<br />

<a href="product_list.php">戻る</a>

</body>
</html>