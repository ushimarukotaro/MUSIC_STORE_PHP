<?php
require_once(__DIR__ . '/header.php');
$showProductAll = new Shop\Model\Product();
$products = $showProductAll->productAll();
?>
<div class="title">
  <h1 class="page__ttl">商品一覧</h1>
  <form action="product_search.php" method="get" class="form-group form-search">
    <div class="form-group">
      <input type="text" name="keyword" placeholder="　検索したい商品名">
    </div>
    <div class="form-group">
      <button type="submit" value="" class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
      <input type="hidden" name="type" value="product_search">
    </div>
  </form>
</div>
<form>
  <ul class="product">
    <?php foreach($products as $product) : ?>
    <li>
      <div class="imgarea">
        <span class="category_name"><?= $product->category_name ?></span>
        <a href="product_disp.php" class="item"><img src="./gazou/<?= $product->image ?>"></a>
      </div>
      <div class="details">
        <div><span class="pro_maker"><?= $product->maker ?></span></div>
        <div><span class="pro_name"><?= $product->product_name ?></span></div>
        <div><span class="pro_price">¥<?= $product->price ?>(税込み)</span></div>
      </div>
      <input type="hidden" name="id">
    </li>
    <?php endforeach; ?>
  </ul>
</form>
<?php
require_once(__DIR__ . '/footer.php');
