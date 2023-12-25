<?php

if(isset($_POST['add'])==true)
{
  header('Location: product_add.php');
  exit();
}

if(isset($_POST['disp']))
{
  if(isset($_POST['procode'])) {
    $pro_code = $_POST['procode'];
    header('Location: product_disp.php?procode=' . $pro_code);
    print '参照ボタンがおされた';
    exit();
  } else {
    header('Location: product_ng.php');
    exit();
  }
}

if(isset($_POST['edit']))
{
  if(isset($_POST['procode'])) {
    $pro_code = $_POST['procode'];
    header('Location: product_edit.php?procode=' . $pro_code);
    print '修正ボタンがおされた';
    exit();
  } else {
    header('Location: product_ng.php');
    exit();
  }
}

if(isset($_POST['delete']))
{
  if(isset($_POST['procode'])) {
    $pro_code = $_POST['procode'];
    header('Location: product_delete.php?procode=' . $pro_code);
    print '削除ボタンがおされた';
  } else {
    header('Location: product_ng.php');
    exit();
  }
}

?>