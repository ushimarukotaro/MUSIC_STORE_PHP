<?php
require_once(__DIR__ . '/header.php');
$showProductAll = new Shop\Model\Product();
$products = $showProductAll->productAll();
?>
<div class="title">
  <h1 class="page__ttl">商品一覧</h1>
  <form action="product_search.php" method="get" class="form-group form-search">
    <div class="form-group">
      <input type="text" name="keyword" placeholder="　検索したい商品名" value="">
    </div>
    <div class="form-group">
      <button type="submit" value="" class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
      <input type="hidden" name="type" value="product_search">
    </div>
  </form>
</div>
<form action="" name="f_page_size" method="get">
  <div class="form-group select-form">
    <span style="margin-left:1rem;">並び順 : </span>
    <select name="sort" class="sort select" onchange="Sort_onChange();">
      <option value="NewArrivals" selected>新着順</option>
      <option value="OldArrivals">古いもの順</option>
      <option value="Price_DESC">値段が高い順</option>
      <option value="Price_ASC">値段が安い順</option>
    </select>
  </div>
</form>
<form id="product_disp" action="">
  <ul class="product">
    <?php foreach($products as $product) : ?>
    <li>
      <div class="imgarea allimgarea">
        <span class="category_name"><?= h($product->category_name) ?></span>
        <a href="<?= SITE_URL ?>/product_disp.php?id=<?= h($product->id) ?>" class="item" onclick="document.getElementById('product_disp').submit"><img src="./gazou/<?= $product->image ?>"></a>
      </div>
      <div class="details">
        <div><span class="pro_maker"><?= h($product->maker) ?></span></div>
        <div><span class="pro_name"><?= h($product->product_name) ?></span></div>
        <div><span class="pro_price">¥<?= h(number_format($product->price)) ?>(税抜き)</span></div>
        <div><span class="pro_price_taxin">¥<?= h(number_format(floor($product->price * 1.10))) ?>(税込み)</span></div>
      </div>
      <!-- <input type="hidden" name="id"> -->
    </li>
    <?php endforeach; ?>
  </ul>
</form>
<!-- sort -->
<form name="f_search" method="get" action="product_all.php">
  <input type="hidden" name="i_sort" value="">
  <input type="hidden" name="type" value="product_sort">
</form>
<?php
require_once(__DIR__ . '/footer.php');
