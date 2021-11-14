<!DOCTYPE html>
<html lang="ja">

<body>
  <?php

  require_once('../common/common.php');

  session_start();
  session_regenerate_id(true);
// 現在のセッションIDを新しく生成したものと置き換える

  try {
    $pro_id = $_GET['pro_code'];

    if (isset($_SESSION['cart'])) {
      // $_SESSION は PHPの定義済み変数(=スーパーグローバル変数)の1つ
      // セッションは、サイトを訪れた個々のユーザーのデータを個別に管理する機能
      $cart = $_SESSION['cart'];
      if (in_array($pro_id, $cart) == true) {
        // PHPのin_array関数は、配列の中に指定した値が存在するかチェックする関数
        // 第一引数には、検索する値を渡し、第二引数には、検索対象の配列を渡します。
        // 上記は$cart内に,$pro_id（!?$pro_idは何を表している？）があるか検索している
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