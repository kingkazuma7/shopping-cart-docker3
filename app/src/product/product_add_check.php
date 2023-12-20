<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ONE PIECE農園</title>
</head>
<body>

<?php
require_once dirname(__FILE__) . '/../common/common.php';

$post=sanitize($_POST);
$product_name = $post['name'];
$product_price = $post['price'];
// $product_image = $post['image'];
$product_image = $_FILES['image'];

if ($product_name == '')
{
  print'商品名が入力されていません。<br />';
}
else
{
  print'商品名:';
  print $product_name;
  print '<br />';
}

// preg_matchは、入力文字列が半角数字の場合、1を返す。マッチしないときは0を返す。
if (preg_match('/\A[0-9]+\z/',$product_price)==0) {
  print'価格をきちんと入力してください。<br />';
} else {
  print '価格:';
  print $product_price;
  print'円<br />';
}

if (isset($product_image)) {
  $image = $_FILES['image'];
  $imageName = $image['name'];
  $imageTmpName = $image['tmp_name'];
  $imageSize = $image['size'];
  $imageType = $image['type'];

  // 画像のサイズとタイプをチェック
  if ($imageSize > 0) {
    if ($imageSize > 2000000) {
        echo '画像が大きすぎます。2MB以下の画像をアップロードしてください。';
        exit();
    }
    if ($imageType != 'image/jpeg' && $imageType != 'image/png') {
        echo 'JPEGまたはPNG画像のみをアップロードできます。';
        exit();
    }
    // 画像を保存
    $imageDestination = './image/' . $imageName;
    move_uploaded_file($imageTmpName, $imageDestination);
    // 画像を表示
    echo '<img src="' . $imageDestination . '" alt="Uploaded image">';
  }
}
?>

</body>
</html>
