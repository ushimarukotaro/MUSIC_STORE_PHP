<?php

namespace Shop\Controller;

class PostReview extends \Shop\Controller {
  public function run() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        echo "不正なトークンです!";
        exit;
      }
      if ($this->hasError()) {
        return;
      } else {
        try {
          $createReview = new \Shop\Model\Product();
          $createReview->postReview([
            'userid' => $_SESSION['me']->id,
            'productid' => $_POST['productid'],
            'hyouka' => $_POST['hyouka'],
            'content' => $_POST['content']
          ]);
        } catch (\Shop\Exception\DuplicateEmail $e) {
          $this->setErrors('email', $e->getMessage());
          return;
        }
        header('Location: ' . SITE_URL . '/purchase_history.php');
        exit();
      }
    }
  }

}
