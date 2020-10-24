<?php
require_once(__DIR__ . '/header.php');
$showProductAll = new Shop\Model\Product();
$product_id = $_GET['id'];
$product = $showProductAll->productShow($product_id);
// var_dump($product);
?>
<div class="title">
  <h1 class="page__ttl">商品詳細</h1>
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
<div class="product-area">
  <div class="product-image">
    <span class="category_name"><?= $product->category_name ?></span>
    <img class="" src="./gazou/<?= $product->image ?>">
  </div>
  <div class="product-disp">
    <form action="" method="post" class="form">
      <div class="details">
        <div class="details-info">
          <div><span class="pro_maker"><?= h($product->maker) ?></span></div>
          <div><span class="pro_name"><?= h($product->product_name) ?></span></div>
          <div><span class="pro_price">¥<?= h(number_format($product->price)) ?>(税抜き)</span></div>
          <div><span class="pro_price_taxin">¥<?= h(number_format(floor($product->price * 1.10))) ?>(税込み)</span></div>
          <span class="product-order">
            注文数：<input type="text" name="order" value="1">
          </span>
        </div>
        <div class="details-input">
          <div id="fav__btn" class="btn btn-dark fav__btn <?= isset($showProductAll->fav_id) ? ' active' : ''; ?>" value=""><i class="far fa-star"></i>欲しい物に追加</div>
          <button type="submit" formaction="cart_list.php" class="btn btn-primary" value=""><i class="fas fa-cart-plus"></i>カートに入れる</button>
        </div>
      </div>
      <p class="product-text"><?= nl2br(h($product->details)) ?></p>

    </form>
  </div>
</div>
<div class="review-area">
  <div class="review">
    <div class="review-user">
      <span>投稿者：牛丸</span>
      <span>投稿日：2020/07/21</span>
    </div>
    <div class="review-details">
      <p>めっちゃよかった。なぜならめっちゃよかったから</p>
    </div>
  </div>
</div>
<?php
require_once(__DIR__ . '/footer.php');
