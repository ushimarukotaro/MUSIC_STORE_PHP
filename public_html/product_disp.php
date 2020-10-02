<?php
require_once(__DIR__ . '/header.php');
?>
<div class="title">
  <h1 class="page__ttl">商品詳細</h1>
  <form action="product_search.php" method="get" class="form-group form-search">
    <div class="form-group">
      <input type="text" name="keyword" placeholder="　検索">
    </div>
    <div class="form-group">
      <button type="submit" value="" class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
      <input type="hidden" name="type" value="searchthread">
    </div>
  </form>
</div>
<div class="product-area">
  <div class="product-image">
    <p>画像イメージ</p>
  </div>
  <div class="product-disp">
    <form action="" method="post" class="form">
      <div class="product-name">
        <h4>Gibson レスポール</h4>
      </div>
      <div class="product-price">
        <p>¥200,000</p>
      </div>
      <div class="product-order">
        注文数：<input type="text" name="order" value="1">
      </div>
      <p class="product-text">
        商品説明商品説明商品説明商品説明商品説明商品説明商品説明商品説明商品説明商品説明商品説明
        商品説明商品説明商品説明商品説明商品説明商品説明商品説明商品説明商品説明商品説明商品説明
        商品説明商品説明商品説明商品説明商品説明商品説明商品説明商品説明商品説明商品説明商品説明
      </p>
      <input type="submit" formaction="product_favorite.php" class="btn btn-primary" value="欲しい物に追加">
      <input type="submit" formaction="cart_list.php" class="btn btn-primary" value="カートに入れる">
    </form>
  </div>
</div>
<div class="review-area">
  <h2 class="page__ttl">レビュー</h2>
  <div class="review">
    <span>投稿者：牛丸</span>
    <span>投稿日：2020/07/21</span>
    <p>
      めっちゃよかった。なぜならめっちゃよかったから
    </p>
  </div>
  <div class="review">
    <span>投稿者：タケミッチ</span>
    <span>投稿日：2020/07/03</span>
    <p>
      めっちゃよかった。なぜならめっちゃよかったから
    </p>
  </div>
</div>
<?php
require_once(__DIR__ . '/footer.php');
