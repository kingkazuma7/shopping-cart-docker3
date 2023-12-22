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
$product_code=$post['code'];
$product_name=$post['name'];
$product_price=$post['price'];
$pro_gazou_name_old=$_POST['gazou_name_old'];
$pro_gazou=$_FILES['image'];

if($product_name=='')
{
    print'商品名が入力されていません。<br />';
    print'You do not enter a product name.<br />';
}
else
{
  print'商品名:';
  print $product_name;
  print '<br />';
}

// preg_matchは、入力文字列が半角数字の場合、1を返す。マッチしないときは0を返す。
if(preg_match('/\A[0-9]+\z/',$product_price)==0)
{
  print'価格をきちんと入力してください。<br />';
}
else
{
  print'価格:';
  print $product_price;
  print'円<br />';
}

if($pro_gazou['size']>0)
{
  if($pro_gazou['size']>1000000)
  {
    print'画像が大きすぎます';
  }
  else
  {
    move_uploaded_file($pro_gazou['tmp_name'],'./image/'.$pro_gazou['name']);
    print'<img src="./pro_gazou/'.$pro_gazou['name'].'">';
    print'hoge';
    print'<br />';
  }
}

// 商品名と価格が空か画像サイズが1MB以上だった場合
if($product_name==''||preg_match('/\A[0-9]+\z/',$product_price)==0||$pro_gazou['size']>1000000)
{
      print'<form>';
      print'<input type="button" onclick="history.back()"value="戻る">';
      print'</form>';
}
else
{
    print'上記のように変更します。<br />';
    print'<form method="post" action="product_edit_done.php">';
    print'<input type="hidden" name="code" value="'.$product_code.'">';
    print'<input type="hidden" name="name" value="'.$product_name.'">';
    print'<input type="hidden" name="price" value="'.$product_price.'">';
    print'<input type="hidden" name="gazou_name_old" value="'.$pro_gazou_name_old.'">';
    print'<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
    print'<br />';
    print'<input type="button" onclick="history.back()" value="戻る">';
    print'<input type="submit" value="OK">';
    print'</form>';
}

?>
</body>
</html>
