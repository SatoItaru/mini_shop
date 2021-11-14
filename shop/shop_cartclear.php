<?php

session_start();
$_SESSION = array();
// ブラウザ内で持っているパラメタを消す
// セッション変数を全て解除する
if (isset($_COOKIE[session_name()]) == true) {
      setcookie(session_name(), '', time() - 42000, '/');
}
// クライアントのブラウザにクッキーとして記録されているセッションIDの破棄を行っている
// session_name() : クッキー変数名
// '' : 破棄する変数
// time() - 42000 : クッキーの期限を設定
// time() : 今この瞬間
// / : ドメイン下の全体に作用

session_destroy();
// 最終的に、セッションを破壊する

echo <<<EOD
      カートを空にしました<br>
      <a href="../index.php">商品一覧に行く</a>
EOD;