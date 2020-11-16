<?php
session_start();
$session_name = session_name();
$_SESSION['cart'] = array();
$_SESSION['num'] = array();

if (isset($_COOKIE[$session_name]) === true) {
  setcookie($session_name, '', time() - 3600);
}

header('Location:cart_list.php');
exit;
