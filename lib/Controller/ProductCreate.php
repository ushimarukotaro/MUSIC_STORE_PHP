<?php

namespace Shop\Controller;

class ProductCreate extends \Shop\Controller
{
  public function run()
  {
    if ($this->isAdminLoggedIn()) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->postProcess();
      }
    } else {
      header('Location: ' . SITE_URL . '/product_create.php');
      exit();
    }
  }

  private function postProcess()
  {
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
    $this->setValues('details', $_POST['details']);
    if ($this->hasError()) {
      return;
    } else {
      $pro_img = $_FILES['image'];
      $ext = substr($pro_img['name'], strrpos($pro_img['name'], '.') + 1);
      $pro_img['name'] = uniqid("img_") . '.' . $ext;
      try {
        $createModel = new \Shop\Model\Product();
        if ($pro_img['size'] > 0) {
          move_uploaded_file($pro_img['tmp_name'], './gazou/' . $pro_img['name']);
          $product = $createModel->createProduct([
            'product_name' => $_POST['product_name'],
            'maker' => $_POST['maker'],
            'category_id' => $_POST['category_id'],
            'price' => $_POST['price'],
            'details' => $_POST['details'],
            'image' => $pro_img['name'],
          ]);
        } else {
          $pro_img = NULL;
        }
      } catch (\Shop\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }
      header('Location: ' . SITE_URL . '/product_manage.php');
      exit();
    }
  }

  public function getCategories()
  {
    $categories = new \Shop\Model\Product();
    $res = $categories->getCategories();
    return $res;
  }


  private function validate()
  {
    // $validate = new \Shop\Controller\Validate();
    // $validate->tokenCheck($_POST['token']);
    // if ($validate->emptyCheck($_POST['product_name'])) {
    //   throw new \Shop\Exception\EmptyPost("入力されていない項目があります！");
    // }
    if ($_POST['product_name'] == '') {
      throw new \Shop\Exception\EmptyPost("商品名が未入力です！");
    }
    if ($_POST['maker'] == '') {
      throw new \Shop\Exception\EmptyPost("メーカーが未入力です！");
    }
    if ($_POST['category_id'] == '') {
      throw new \Shop\Exception\UnSelected("カテゴリーが未選択です！");
    }
    if ($_POST['price'] == '') {
      throw new \Shop\Exception\InvalidPrice("値段が未入力です！");
    }
    if ($_POST['details'] == '') {
      throw new \Shop\Exception\InvalidDetails("商品説明が未入力です！");
    }
  }
}
