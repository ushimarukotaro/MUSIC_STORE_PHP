<?php
require_once(__DIR__ . '/header.php');
$searchProductsCon = new Shop\Controller\ProductSearch();
$products = $searchProductsCon->run();
?>
<div class="title">
  <h1 class="page__ttl">商品検索</h1>
</div>
<form action="product_search.php" method="get" class="form-group form-search">
  <div class="form-group">
    <input type="text" name="keyword" placeholder="　検索したい商品名" value="<?= isset($searchProductsCon->getValues()->keyword) ? h($searchProductsCon->getValues()->keyword) : ''; ?>">
    <p class="err"><?= h($searchProductsCon->getErrors('keyword')); ?></p>
  </div>
  <div class="form-group">
    <button type="submit" value="" class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
    <input type="hidden" name="type" value="product_search">
  </div>
</form>
<?php $products != '' ? $con = count($products) : $con = ''; ?>
<?php if (($searchProductsCon->getErrors('keyword'))) : ?>
<?php else : ?>
  <div>キーワード：　<?= $_GET['keyword']; ?>　該当件数：<?= $con; ?>件</div>
<?php endif; ?>
<form id="product_disp" action="">
  <ul class="product">
    <?php if ($con >= 1) : ?>
      <?php foreach ($products as $product) : ?>
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
          <input type="hidden" name="id">
        </li>
      <?php endforeach; ?>
    <?php elseif ($con == 0) : ?>
      <p class="err">該当する商品は見つかりませんでした</p>
    <?php endif; ?>
  </ul>
</form>


<?php
require_once(__DIR__ . '/footer.php');
?>