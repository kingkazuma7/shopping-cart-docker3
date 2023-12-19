<?php

if(isset($_POST['add'])==true)
{
  header('Location: staff_add.php');
  exit();
}

if(isset($_POST['disp']))
{
  if(isset($_POST['staffcode'])) {
    $staff_code = $_POST['staffcode'];
    header('Location: staff_disp.php?staffcode=' . $staff_code);
    print '参照ボタンがおされた';
    exit();
  } else {
    header('Location: staff_ng.php');
    exit();
  }
}

if(isset($_POST['edit']))
{
  if(isset($_POST['staffcode'])) {
    $staff_code = $_POST['staffcode'];
    header('Location: staff_edit.php?staffcode=' . $staff_code);
    print '修正ボタンがおされた';
    exit();
  } else {
    header('Location: staff_ng.php');
    exit();
  }
}

if(isset($_POST['delete']))
{
  if(isset($_POST['staffcode'])) {
    $staff_code = $_POST['staffcode'];
    header('Location: staff_delete.php?staffcode=' . $staff_code);
    print '削除ボタンがおされた';
  } else {
    header('Location: staff_ng.php');
    exit();
  }
}

?>