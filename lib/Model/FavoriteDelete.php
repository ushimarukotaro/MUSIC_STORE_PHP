<?php

namespace Shop\Controller;

class FavoriteDelete extends \Shop\Controller {
  public function run() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type']) == 'fav_delete') {
      // バリデーション
      if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        echo "不正なトークンです!";
        exit;
      }

    $proModel = new \Shop\Model\Product();
    $proModel->deleteFav([
      'product_id' => $_POST['product_id'],
      'user_id' => $_POST['user_id'],
    ]);

    header('Location: ' . SITE_URL . '/product_favorite.php');
    exit();
    }
  }
}
