<?php

namespace Shop\Controller;

class ProductUpdate extends \Shop\Controller
{
  public function run() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === 'productupdate') {
      $this->updateProduct();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === 'imgdelete') {
      $this->imgDelete();
    }
  }

  protected function updateProduct() {
    try {
      $this->validate();
    } catch (\Shop\Exception\EmptyPost $e) {
      $this->setErrors('product_name', $e->getMessage());
    } catch (\Shop\Exception\EmptyPost $e) {
      $this->setErrors('maker', $e->getMessage());
    } catch (\Shop\Exception\UnSelected $e) {
      $this->setErrors('category_id', $e->getMessage());
    } catch (\Shop\Exception\InvalidPrice $e) {
      $this->setErrors('price', $e->getMessage());
    } catch (\Shop\Exception\InvalidDetails $e) {
      $this->setErrors('details', $e->getMessage());
    }
    $this->setValues('product_name', $_POST['product_name']);
    $this->setValues('maker', $_POST['maker']);
    $this->setValues('category_id', $_POST['category_id']);
    $this->setValues('price', $_POST['price']);
    $this->setValues('delflag', $_POST['delflag']);
    $this->setValues('details', $_POST['details']);
    if ($this->hasError()) {
      return;
    } else {
      $pro_img = $_FILES['image'];
      $old_img = $_POST['old_image'];
      $ext = substr($pro_img['name'], strrpos($pro_img['name'], '.') + 1);
      $pro_img['name'] = uniqid("img_") . '.' . $ext;
      if ($old_img == '') {
        $old_img = NULL;
      }
      try {
        $createModel = new \Shop\Model\Product();
        if ($pro_img['size'] > 0) {
          unlink('./gazou/' . $old_img);
          move_uploaded_file($pro_img['tmp_name'], './gazou/' . $pro_img['name']);
          $createModel->updatePro([
            'product_name' => $_POST['product_name'],
            'maker' => $_POST['maker'],
            'category_id' => $_POST['category_id'],
            'price' => $_POST['price'],
            'delflag' => $_POST['delflag'],
            'details' => $_POST['details'],
            'image' => $pro_img['name'],
            'id' => $_POST['id']
          ]);
          $pro_img = $pro_img['name'];
        } else {
          $createModel->updatePro([
            'product_name' => $_POST['product_name'],
            'maker' => $_POST['maker'],
            'category_id' => $_POST['category_id'],
            'price' => $_POST['price'],
            'delflag' => $_POST['delflag'],
            'details' => $_POST['details'],
            'image' => $old_img,
            'id' => $_POST['id']
          ]);
          $pro_img = $old_img;
        }
      } catch (\Shop\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }
    }
    header('Location: ' . SITE_URL . '/product_manage.php');
    exit();
  }

  protected function imgDelete() {
    $pro_img = $_FILES['image'];
    $old_img = $_POST['old_image'];
    if ($old_img !== '') {
      $userModel = new \Shop\Model\User();
      $userModel->imgDelete();
      unlink('./gazou/' . $old_img);
      $pro_img = NULL;
      header('Location: ' . SITE_URL . '/product_manage.php');
      exit();
    }
  }

  private function validate() {
    $validate = new \Shop\Controller\Validate();
    $validate->tokenCheck($_POST['token']);
    // $validate->unauthorizedCheck([$_POST['email'], $_POST['username']]);
    // if ($validate->mailCheck($_POST['email'])) {
    //   throw new \Shop\Exception\InvalidEmail("メールアドレスの形式が不正です!");
    // }
    // if ($validate->emptyCheck([$_POST['username']])) {
    //   throw new \Shop\Exception\EmptyPost("ユーザー名が入力されていません");
    // }
  }
}
