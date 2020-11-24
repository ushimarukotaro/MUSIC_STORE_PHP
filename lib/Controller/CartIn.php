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
        }
      }
    }
  }

  private function cartIn() {
    $id = $_POST['id'];

    if (isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
      $num = $_SESSION['num'];
      if(in_array($id,$cart)) {
        echo 'コチラの商品はカートに追加済みです';
        echo '<a class="btn btn-link" href="javascript:history.back();">戻る</a>';
        exit();
      }
    }
    $cart[] = $id;
    $num[] = $_POST['num'];
    $_SESSION['cart'] = $cart; 
    $_SESSION['num'] = $num; //セッションにデータを格納

  }

  public function cartDelete() {
    if (isset($_POST['type']) == 'cart_delete') {
      $cart = $_SESSION['cart'];
      $num = $_SESSION['num'];
    }
    
    for ($i=0;$i<count($_SESSION['cart']);$i++) {
      if(isset($_POST['del_id' . $i])) {
        array_splice($cart,$i,1);
        array_splice($num,$i,1);
      }
    }
    $_SESSION['cart'] = $cart;
    $_SESSION['num'] = $num;

    header('Location:cart_list.php');
    exit();
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

  public function showSubTotal() {
    $cart = $_SESSION['cart'];
    $num = $_SESSION['num'];
    $max = count($_SESSION['cart']);
    foreach ($cart as $key => $value) {

    $cartDisplay = new \Shop\Model\Product();
    $res = $cartDisplay->cartProducts($value);
    $price[] = $res['price'];
    }

    for ($i = 0;$i < $max; $i++) {
      $subTotal[] = ($price[$i] * $num[$i]) * 1.1;
    }

    $total = 0;
    foreach ($subTotal as $key => $value) {
      $total = ($total + $value);
    }
    // var_dump($subTotal);
    return number_format(floor($total));

  }
}
