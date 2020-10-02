<?php
require_once(__DIR__ . '/header.php');
$LoginCon = new Bbs\Controller\Login();
$LoginCon->run();
?>
<div class="title index">
  <h1 class="page__ttl">オリジナルショップ</h1>
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
<div class="index-nav">
  <p><a href="product_all.php" class="name">商品一覧ページへ</a></p>
  <p><a href="login.php" class="name">ログインページへ</a></p>
  <p><a href="signup.php" class="name">会員登録ページへ</a></p>
</div>
<?php
require_once(__DIR__ . '/footer.php');
