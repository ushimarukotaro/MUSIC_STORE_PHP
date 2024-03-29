<?php
namespace Shop\Controller;

class ProductSearchManage extends \Shop\Controller {

  public function run() {
    if($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['type'] === 'product_search') {
      $productData = $this->searchProduct();
      return $productData;
    }
  }

  public function searchProduct(){
    try {
      $this->validate();
    } catch (\Shop\Exception\CharLength $e) {
      $this->setErrors('keyword', $e->getMessage());
    }

    $keyword = $_GET['keyword'];
    $this->setValues('keyword', $keyword);
    if ($this->hasError()) {
      return;
    } else {
      $productModel = new \Shop\Model\Product();
      $productData = $productModel->searchProductManage($keyword);
      // var_dump($productData);exit;
      return $productData;
    }
  }

  private function validate() {
    $validate = new \Shop\Controller\Validate();
    if($validate->charLengthCheck($_GET['keyword'],20)) {
      throw new \Shop\Exception\CharLength("キーワードは20文字以内で入力してください。");
    }
  }
}
