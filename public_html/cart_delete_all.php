<?php
session_start();
$session_name = session_name();
$_SESSION['cart'] = array();
// unset($_SESSION['cart']);
if (isset($_COOKIE[$session_name]) === true) {
  setcookie($session_name, '', time() - 3600);
}
// session_destroy();
header('Location:cart_list.php');
exit;
