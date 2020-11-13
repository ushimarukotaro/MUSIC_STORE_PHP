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
    // $num = $_POST['num'];

    if (isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
      $num = $_SESSION['num'];
    }
    $cart[] = $id;
    $num[] = $_POST['num'];
    $_SESSION['cart'] = $cart; 
    $_SESSION['num'] = $num; //セッションにデータを格納

    // var_dump($cart);
    // exit;
  }

  private function cartDelete() {
    
  }

  public function numChange() {
    if (isset($_POST['type']) == 'num_change') {

      $max = count($_SESSION['cart']);

      for ($i = 0;$i < $max; $i++) {
        $num[] = $_POST['num' . $i];
      }
      $_SESSION['num'] = $num;
  
      header('Location:cart_list.php');
      exit();
    }
  }
}
