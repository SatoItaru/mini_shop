<!DOCTYPE html>
<html lang="ja">

<body>
  <?php

  require_once('../common/common.php');

  session_start();
  // セッション開始方法
  // session_id が発行され、Cookie に保存される
  session_regenerate_id(true);
// 新しく生成したセッションIDと置き換える

  try {
    $pro_id = $_GET['pro_code'];

    if (isset($_SESSION['cart'])) {
      // $_SESSION は PHPの定義済み変数(=スーパーグローバル変数)の1つ
      // セッションは、サイトを訪れた個々のユーザーのデータを個別に管理する機能
      $cart = $_SESSION['cart'];
      if (in_array($pro_id, $cart) == true) {
        // 配列の中に指定した値が存在するか否か
        // 第一引数＝"検索する値"を渡し、第二引数＝"検索対象の配列"を渡します。
        // $cart内に,$pro_id（!?$pro_idは何を表している？）があるか検索している
        echo 'この商品はすでにカートに入っています。
            <br>
            <a href="../index.php">商品一覧に戻る</a>';
        exit();
      }
    }

    $cart[] = $pro_id;
    $_SESSION['cart'] = $cart;
  } catch (Exception $e) {
    echo '何かしらのエラーが発生しています';
    echo $e->getMessage();
    exit();
  }
  ?>

  カートに追加しました。<br>
  <a href="../index.php">商品一覧に戻る</a>
</body>

</html>