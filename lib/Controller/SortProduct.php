<?php
namespace Shop\Controller;

class SortProduct extends \Shop\Controller {
  public function run() {
    if($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['type'] === 'product_sort') {
      $sortProduct = $this->sortProduct();
      return $sortProduct;
    }
  }

  public function sortProduct() {
    $sort = $_GET['sort'];
    $this->setValues('sort',$sort);
    if ($this->hasError()) {
      return;
    }
    if ($_GET['i_sort'] === 'OldArrivals') {
      $sortProduct = new \Shop\Model\Product;
      $sortData = $sortProduct->oldArrivals();
      return $sortData;
    } elseif ($_GET['i_sort'] === 'NewArrivals') {
      $sortProduct = new \Shop\Model\Product;
      $sortData = $sortProduct->productAll();
      return $sortData;
    } elseif ($_GET['i_sort'] === 'Price_DESC') {
      $sortProduct = new \Shop\Model\Product;
      $sortData = $sortProduct->sortPriceDesc();
      return $sortData;
    } elseif ($_GET['i_sort'] === 'Price_ASC') {
      $sortProduct = new \Shop\Model\Product;
      $sortData = $sortProduct->sortPriceAsc();
      return $sortData;
    }
    // header('Location: ' . SITE_URL . '/product_all.php');
    // exit();
  }
}