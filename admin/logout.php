<?php
  
session_start();

if (isset($_SESSION['admin_id'])) {
    $_SESSION = array();

    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 3600);
    }
    session_destroy();
}

setcookie('admin_id', '', time() - 3600);
setcookie('admin_name', '', time() - 3600);
setcookie('admin_auth_keys', '', time() - 3600);

$login_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login';
header('Location: ' . $login_url);

?>
