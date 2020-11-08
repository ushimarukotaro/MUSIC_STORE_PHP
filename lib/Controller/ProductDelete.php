<?php

namespace Shop\Controller;

class ProductDelete extends \Shop\Controller {
  public function run() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type']) == 'delete') {
      // バリデーション
      if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        echo "不正なトークンです!";
        exit;
      }

    $userModel = new \Shop\Model\User();
    $userModel->adminDelete([
      'id' => $_POST['id'],
    ]);

    header('Location: ' . SITE_URL . '/product_manage.php');
    exit();
    }
  }
}
