<?php
namespace Shop\Controller;

class SortProduct extends \Shop\Controller {
  public function run() {
    if($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['type'] === 'product_sort') {
      $sortProduct = $this->sortProduct();
      return $sortProduct;
    } elseif($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['type'] === 'product_sort_category') {
      $sortProduct = $this->sortProductCategory();
      return $sortProduct;
    }
  }

  public function sortProduct() {
    $i_sort = $_GET['i_sort'];
    $this->setValues('i_sort',$i_sort);
    // var_dump($i_sort);
    // exit;
    if ($this->hasError()) {
      return;
    }
    if ($i_sort === 'NewArrivals') {
    $sortProduct = new \Shop\Model\Product;
    $sortData = $sortProduct->productAll();
    return $sortData;
    } elseif ($i_sort === 'OldArrivals') {
      $sortProduct = new \Shop\Model\Product;
      $sortData = $sortProduct->oldArrivals();
      return $sortData;
    } elseif ($i_sort === 'Price_DESC') {
      $sortProduct = new \Shop\Model\Product;
      $sortData = $sortProduct->sortPriceDesc();
      return $sortData;
    } elseif ($i_sort === 'Price_ASC') {
      $sortProduct = new \Shop\Model\Product;
      $sortData = $sortProduct->sortPriceAsc();
      return $sortData;
    }
  }

  public function sortProductCategory() {
    $i_sort = $_GET['i_sort'];
    $this->setValues('i_sort',$i_sort);
    if ($this->hasError()) {
      return;
    }
    if ($i_sort === 'NewArrivals') {
    $sortProduct = new \Shop\Model\Product;
    $sortData = $sortProduct->productCategory($_GET['id']);
    return $sortData;
    } elseif ($i_sort === 'OldArrivals') {
      $sortProduct = new \Shop\Model\Product;
      $sortData = $sortProduct->productCategoryOld($_GET['id']);
      return $sortData;
    } elseif ($i_sort === 'Price_DESC') {
      $sortProduct = new \Shop\Model\Product;
      $sortData = $sortProduct->productCategoryPriceDesc($_GET['id']);
      return $sortData;
    } elseif ($i_sort === 'Price_ASC') {
      $sortProduct = new \Shop\Model\Product;
      $sortData = $sortProduct->productCategoryPriceAsc($_GET['id']);
      return $sortData;
    }
  }
}