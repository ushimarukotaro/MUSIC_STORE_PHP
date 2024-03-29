<?php
require_once(__DIR__ . '/header.php');
?>
<div class="title index">
  <h1 class="page__ttl">ウシマル楽器</h1>
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
<div class="row">
  <div class="index-nav col-md-6">
    <p><a href="product_all.php" class="name">商品一覧ページへ</a></p>
    <?php if (!isset($_SESSION['me'])) : ?>
      <p><a href="login.php" class="name">ログインページへ</a></p>
      <p><a href="signup.php" class="name">会員登録ページへ</a></p>
    <?php endif; ?>
  </div>
  <div class="col-md-6 img_area">
    <img src="./asset/img/music_guitar_syuuri.png">
  </div>
</div>

<?php
require_once(__DIR__ . '/footer.php');
