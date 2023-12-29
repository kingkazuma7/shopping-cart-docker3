<?php
require_once dirname(__FILE__) . '/../common/common.php';
session_login(); // login
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ONE PIECE農園</title>
</head>
<body>

<?php
$post=sanitize($_POST);
$product_name = $post['name'];
$product_price = $post['price'];
// $product_image = $post['image'];
$product_image = $_FILES['image'];
// var_dump($product_image['name']);

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
    // （元の保存場所、アップロード先、ファイル名）
    // 画像を表示
    echo '<img src="' . $imageDestination . '" alt="Uploaded image">';
  }
}

// 商品名と価格が空だったら
if ($product_name == ''||preg_match('/\A[0-9]+\z/', $product_price) == 0 || $product_image['size']> 1000000) {
  print'<form>';
  print'<input type="button" onclick="history.back()"value="戻る">';
  print'</form>';
} else {
  print'上記の商品を追加します。<br />';
  print'<form method="post" action="product_add_done.php">';
  print'<input type="hidden" name="name" value="'.$product_name.'">';
  print'<input type="hidden" name="price" value="'.$product_price.'">';
  print'<input type="hidden" name="image" value="'.$product_image['name'].'">';
  print'<br />';
  print'<input type="button" onclick="history.back()" value="戻る">';
  print'<input type="submit" value="OK">';
  print'</form>';
}
?>

</body>
</html>
