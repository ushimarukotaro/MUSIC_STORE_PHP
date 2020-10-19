<?php

namespace Shop\Controller;

class UserManage extends \Shop\Controller {
  public function run() {
    if($this->isAdminLoggedIn()) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->postProcess();
      }
    } else {
      header('Location: '. SITE_URL . '/product_all.php');
      exit();
    }
  }

  public function adminShow() {
    $userModel = new \Shop\Model\User();
    $products = $userModel->adminShow();
    return $products;
  }

  public function adminDispShow() {
    $userModel = new \Shop\Model\User();
    $product = $userModel->adminDispShow([
      'product_id' => $_GET['product_id'],
      // 'product_name' => $_POST['product_name'],
    ]);
    return $product;
  }

  private function postProcess() {
    if(isset($_POST['update']) || isset($_POST['delete'])) {
      try {
        $this->validate();
      } catch (\Shop\Exception\EmptyPost $e) {
          $this->setErrors('id', $e->getMessage());
      }
      $this->setValues('id', $_POST['id']);
      if ($this->hasError()) {
        return;
      } else {
        $userModel = new \Shop\Model\User();
      }
    }

    if(isset($_POST['update'])) {
      $id = $_POST['id'];
      $product_name = $_POST['product_name' . $_POST['id']];
      $maker = $_POST['maker' . $_POST['id']];
      $category_id = $_POST['category_id' . $_POST['id']];
      $image = $_POST['image' . $_POST['id']];
      $price = $_POST['price' . $_POST['id']];
      $details = $_POST['details' . $_POST['id']];

      if(empty($image)) {
        $image = NULL;
      }

      $userModel->adminUpdate([
        'id' => $id,
        'product_name' => $product_name,
        'maker' => $maker,
        'category_id' => $category_id,
        'image' => $image,
        'price' => $price,
        'details' => $details,
      ]);
      header('Location: '. SITE_URL . '/product_manage.php');
      exit();
    } elseif(isset($_POST['delete'])) {
      $userModel->adminDelete($_POST['id']);
      header('Location: '. SITE_URL . '/product_manage.php');
      exit();
    } elseif(isset($_POST['create'])) {
      header('Location: '. SITE_URL . '/product_manage_create.php');
      exit();
    }
  }

  private function validate() {
    $validate = new \Shop\Controller\Validate();
    $validate->tokenCheck($_POST['token']);
    if (is_null($_POST['product'])) {
      throw new \Shop\Exception\EmptyPost("ユーザーを選択してください");
    }

  }
}
