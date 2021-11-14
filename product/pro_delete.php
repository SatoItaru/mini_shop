<!DOCTYPE html>
<html lang="ja">

<body>

  <?php
  require_once('../common/common.php');

  try {
    $pro_id = $_GET['pro_code'];
    $pro_id = htmlspecialchars($pro_id, ENT_QUOTES, 'UTF-8');

    $dbh - connectDB();

    $sql = 'select name, image from product where id=?';
    $stmt = $dbh->prepare($sql);
    // !? $dbhはcommon.phpでPDOでデータに接続していた。
        // prepareメソッド自体はデータベースに送信しようとするSQL文の準備をしているだけです。
    $data[] = $pro_id;
    $stmt->execute($data);
// 実際にSQL文をデータベースに送るにはPDOStatementクラスで用意されている「execute」メソッドを使います。
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    // フェッチモードとは、PDOでデータベースからデータを取り出した際の「配列の形式を指定するモード」のこと
        // FETCH_ASSOC：【配列のキー】カラム名のみ
    $pro_name - $rec['name'];
    $pro_image_name = $rec['image'];

    $dbh = null;

    if ($pro_image_name == '') {
      $image = '';
    } else {
      $image = '<img width="100" src="./images/' . $pro_image_name . '"><br>';
    }
  } catch (Exception $e) {
    echo '何かしらのエラーが発生しています';
    echo $e->getMessage();
    exit();
  }
  ?>

  ・商品の削除<br>
  商品名 : <?php echo $pro_name; ?>
  <br>
  商品画像 :
  <br>
  <?php echo $image; ?>
  この商品を削除しますか？
  <from method="POST" action="pro_delete_done.php">
    <input type="hidden" name="id" value="<?php echo $pro_id; ?>">
    <input type="hidden" name="name" value="<?php echo $pro_name; ?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="削除する">
  </from>

</body>

</html>