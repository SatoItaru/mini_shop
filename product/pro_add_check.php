<?php

require_once('../common/common.php');

$post = sanitize($_POST);

$pro_name = $post['name'];
$pro_price = $post['price'];
$pro_image = $_FILES['image'];

if ($pro_name == '') {
  echo '商品名を入力してください..<br>';
} elseif (!preg_match('/^[0-9]+$/', $pro_price)) {
  //   preg_match : preg_matchではある文字列から正規表現で指定したパターンにマッチした文字列を検索することができます
// ^ : 先頭
// ^[0-9] : 文字の先頭が数字のものにマッチ
// ＋ : その前にあるもの(この場合は数字)が１回以上繰り返す場合にマッチ
// $  : 文字列の終わりにマッチ
// ＋$ : その前にあるものが終わりまで繰り返すことを意味
// ^[0-9]+$ : ２文字以上の数字だけの文字列にマッチ
  echo '正しい金額を入力してください..<br>';
} else {
  echo <<<EOD
  商品名 : $pro_name
  <br>
  商品の価格 : $pro_price 円
  <br>
EOD;
}
// 画像の取り扱い
// $pro_image = $_FILES['image'];
// $pro_image['size'] 画像のサイズ、単位はバイト
// $pro_image['temp_name']　仮にアップロードされている画像本体の場所と名前
// $pro_image['name']　画像のファイル名
// move_uploaded_file(移動元、移動先);
// [/]フォルダの区切り
// [.]プログラムと同じ階層のフォルダ

if ($pro_image['size'] > 0) {
  if ($pro_image['size'] > 1000000) {
    echo '画像サイズが大きすぎます..';
  } else {
    move_uploaded_file($pro_image['tmp_name'], './images/' . $pro_image['name']);
    echo '<img width="100" src="./images/' . $pro_image['name'] . '"><br>';
  }
}

if ($pro_name == '' || preg_match('/^[0-9]+$/', $pro_price) == 0 || $pro_image['size'] > 1000000) {
  echo <<<EOD
  <form>
    <input type="button" onclick="history.back()" value="戻る">
  </form>
EOD;
} else {
  echo <<<EOD
  <form method="POST" action="pro_add_done.php">
    <input type="hidden" name="name" value="$pro_name">
    <input type="hidden" name="price" value="$pro_price">
    <input type="hidden" name="image_name" value="$pro_image[name]">
    <br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="追加する">
  </form>
EOD;
}