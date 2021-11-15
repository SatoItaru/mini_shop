<?php

session_start();
$_SESSION = array();

if (isset($_COOKIE[session_name()]) == true) {
  setcookie(session_name(), '', time() - 42000, '/');
}
// $_COOKIEは現在のスクリプトに HTTP クッキーから渡された変数の連想配列

session_destroy();

echo <<<EOD
  ログアウトしました<br>
  <a href="staff_login.php">ログイン画面へ</a>
EOD;