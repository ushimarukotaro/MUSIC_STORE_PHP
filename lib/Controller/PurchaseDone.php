<?php

namespace Shop\Controller;

class PurchaseDone extends \Shop\Controller {
  public function run() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        echo "不正なトークンです!";
        exit;
      }
      if(!isset($_SESSION['cart']) || !isset($_SESSION['num'])) {
        header('Location: ' . SITE_URL . '/product_all.php');
        exit();
      }
      $cart = $_SESSION['cart'];
      $num = $_SESSION['num'];

      $purchase = new \Shop\Model\Product();
      for($i = 0;$i < count($cart);$i++) {
        $purchase->purchaseDone([
          'product_id' => $cart[$i],
          'user_id' => $_SESSION['me']->id,
          'num' => $num[$i],
          ]);
        }
        $_SESSION['cart'] = array();
        $_SESSION['num'] = array();
    }
  }
}