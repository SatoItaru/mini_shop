<?php

require_once('../common/common.php');

try {

  $staff_name = $_POST['name'];
  $staff_pass = $_POST['pass'];

  $dbh = connectDB();//DBに接続

  $sql = 'insert into staff (name, password) values (?, ?)';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_name; //[]配列にする
  $data[] = $staff_pass;
  $stmt->execute($data);//実行する

  $dbh = null;//DBの接続を切る
} catch (Exception $e) {
  echo '何かしらのエラーが発生しています';
  echo $e->getMessage();
  exit();
}

echo $staff_name . ' の登録が完了しました<br>';
echo '<a href="staff_login.php">ログインする</a>';