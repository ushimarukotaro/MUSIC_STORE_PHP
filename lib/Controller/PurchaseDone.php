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
        header('Location: ' . SITE_URL . '/product_al.php');
        exit();
      }
      $carts = $_SESSION['cart'];
      $nums = $_SESSION['num'];

      $purchase = new \Shop\Model\Product();
      // $purchase->purchaseDone([
      //     'product_id' => $carts,
      //     'user_id' => $_SESSION['me']->id,
      //     'num' => $nums,
      //     ]);
        // }

    }
  }
}