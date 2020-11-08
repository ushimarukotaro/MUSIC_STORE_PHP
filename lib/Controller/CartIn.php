<?php

namespace Shop\Controller;

class CartIn extends \Shop\Controller {
  public function run(){
    if ($this->isLoggedIN()) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // バリデーション
        if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
          echo "不正なトークンです!";
          exit;
        }
        if (isset($_POST['type']) == 'cart_in') {
          $this->cartIn();
        } else if (isset($_POST['type']) == 'cart_delete') {
          $this->cartDelete();
        }
      }
    }
  }

  private function cartIn() {
    $id = $_POST['id'];
    $num = $_POST['num'];
    $_SESSION['cart'][$id] = $num; //セッションにデータを格納
    $cart = array();
    if (isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
    }
    // $_SESSION['cart'] = $cart;
    foreach ($cart as $key => $val) {
      $cartProducts = new \Shop\Model\Product();
      $data[0] = $val;
      $res = $cartProducts->cartProducts($data);

      $name[] = $res['product_name'];
      $maker[] = $res['maker'];
      $price[] = $res['price'];
      $image[] = $res['image'];
      $category[] = $res['category_name'];

      // $cart = $res;
      // $_SESSION['cart'] = $cart;
    }
    var_dump($cart);
    var_dump($res);
  }

  private function cartDelete() {
    
  }
}
