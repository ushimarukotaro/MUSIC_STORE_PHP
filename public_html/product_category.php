<?php
require_once(__DIR__ . '/header.php');
$showProductAll = new Shop\Model\Product();
$category_id = $_GET['id'];
$category_name = $showProductAll->getCategory($category_id);
$products = $showProductAll->productCategory($category_id);
// var_dump($category_name);
$showProductSort = new Shop\Controller\SortProduct();
if (isset($_GET['i_sort'])) {
  $products = $showProductSort->sortProductCategory();
}
?>
<div class="title">
  <h1 class="page__ttl"><?= $category_name->category_name ?></h1>
  <form action="product_search.php" method="get" class="form-group form-search">
    <div class="form-group">
      <input type="text" name="keyword" class="form-control" placeholder="検索したい商品名">
    </div>
    <div class="form-group">
      <button type="submit" value="" class="btn btn-secondary search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
      <input type="hidden" name="type" value="product_search">
    </div>
  </form>
</div>
<form action="" name="f_page_size" method="get">
  <div class="form-group select-form">
    <span>並び順 : </span>
    <select name="sort" class="sort select form-control" onchange="Sort_onChange();">
      <option value="NewArrivals" <?= array_key_exists('i_sort', $_GET) && $_GET['i_sort'] == 'NewArrivals' ? 'selected' : ''; ?>>新着順</option>
      <option value="OldArrivals" <?= array_key_exists('i_sort', $_GET) && $_GET['i_sort'] == 'OldArrivals' ? 'selected' : ''; ?>>古いもの順</option>
      <option value="Price_DESC" <?= array_key_exists('i_sort', $_GET) && $_GET['i_sort'] == 'Price_DESC' ? 'selected' : ''; ?>>値段が高い順</option>
      <option value="Price_ASC" <?= array_key_exists('i_sort', $_GET) && $_GET['i_sort'] == 'Price_ASC' ? 'selected' : ''; ?>>値段が安い順</option>
    </select>
  </div>
</form>
<form id="product_disp" action="">
  <ul class="product">
    <?php foreach($products as $product) : ?>
    <li>
      <div class="imgarea allimgarea">
        <span class="category_name"><?= $product->category_name ?></span>
        <a href="<?= SITE_URL ?>/product_disp.php?id=<?= $product->id ?>" class="item" onclick="document.getElementById('product_disp').submit"><img src="./gazou/<?= $product->image ?>"></a>
      </div>
      <div class="details">
        <div><span class="pro_maker"><?= $product->maker ?></span></div>
        <div><span class="pro_name"><?= $product->product_name ?></span></div>
        <div><span class="pro_price">¥<?= number_format($product->price) ?>(税抜き)</span></div>
        <div><span class="pro_price_taxin">¥<?= number_format(floor($product->price * 1.10)) ?>(税込み)</span></div>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
</form>
<!-- sort -->
<form name="f_search" method="get" action="product_category.php">
  <input type="hidden" name="i_sort" value="">
  <input type="hidden" name="type" value="product_sort_category">
  <input type="hidden" name="id" value="<?= $category_id; ?>">
</form>
<?php
require_once(__DIR__ . '/footer.php');
