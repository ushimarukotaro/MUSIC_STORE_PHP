<?php
require_once(__DIR__ . '/header.php');
$showProductDisp = new Shop\Model\Product();
$product_id = $_GET['id'];
if(isset($_SESSION['me'])) {
  $product = $showProductDisp->productShow($product_id);
} else {
  $product = $showProductDisp->productShowDisp($product_id);
}
$reviews = $showProductDisp->getReview($product_id);
$app = new Shop\Controller\CartIn();
$app->run();
// var_dump($reviews);
?>
<div class="title">
  <h1 class="page__ttl">商品詳細</h1>
  <form action="product_search.php" method="get" class="form-group form-search">
    <div class="form-group">
      <input type="text" name="keyword" class="form-control" placeholder="　検索したい商品名" value="">
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
    <form id="cartin" action="" method="post" class="form">
      <div class="details" data-productid="<?= $product_id; ?>">
        <div class="details-info">
          <div><span class="pro_maker"><?= h($product->maker) ?></span></div>
          <div><span class="pro_name"><?= h($product->product_name) ?></span></div>
          <div><span class="pro_price">¥<?= h(number_format($product->price)) ?>(税抜)</span></div>
          <div><span class="pro_price_taxin">¥<?= h(number_format(floor($product->price * 1.10))) ?>(税込)</span></div>
          <span class="product-order">
            注文数：<input type="text" name="num" value="1" maxlength="2" oninput="value = value.replace(/[^0-9]+/i,'');">
          </span>
        </div>
        <div class="details-input">
          <div id="fav__btn" class="btn btn-dark fav__btn<?= isset($product->f_id) ? ' active' : ''; ?>"><i class="far fa-star"></i>欲しい物に追加</div>
          <button onclick="document.getElementById('cartin').submit();" class="btn btn-primary cart__btn"><i class="fas fa-cart-plus"></i>カートに入れる</button>
        </div>
      </div>
      <p class="product-text"><?= nl2br(h($product->details)) ?></p>
      <input type="hidden" name="type" value="cart_in">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <input type="hidden" name="id" value="<?= $product_id; ?>">
    </form>
  </div>
</div>
<?php if(isset($reviews)) : ?>
<div class="review-area">
  <p class="review-num">レビュー数：<?= count($reviews); ?>件</p>
  <?php foreach($reviews as $review) : ?>
  <div class="review">
    <div class="review-user">
      <span>投稿者：<?= h($review->u_name); ?></span>
      <span>投稿日：<?= h(substr($review->r_created,0,11)); ?></span>
      <span>評価：<?= h($review->hyouka); ?></span>
      <span>ID：<?= h($review->r_id); ?></span>
      <?php if($_SESSION['me']->id == $review->r_userid || $_SESSION['me']->authority == '99') : ?>
        <span>
          <form id="review_delete" action="review_delete.php" method="get">
            <button class="btn btn-danger" onclick="reviewDelete();">レビューを削除する</button>
            <input type="hidden" name="review_id" value="<?= h($review->r_id); ?>">
            <input type="hidden" name="p_id" value="<?= h($review->productid); ?>">
          </form>
        </span>
      <?php endif; ?>
    </div>
    <div class="review-details">
      <p><?= nl2br(h($review->content)) ?></p>
    </div>
  </div>
  <?php endforeach; ?>
</div>
  <?php endif; ?>
<?php
require_once(__DIR__ . '/footer.php');
