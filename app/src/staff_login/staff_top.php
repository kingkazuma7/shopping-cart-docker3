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

ショップ管理トップメニュー<br />
<br />
<a href="../staff/staff_list.php">スタッフ管理</a><br />
<br />
<a href="../product/product_list.php">商品管理</a><br />
<br />
<a href="../order/order_download.php">注文ダウンロード</a><br />
<br />
<a href="staff_logout.php">ログアウト</a><br />

</body>
</html>