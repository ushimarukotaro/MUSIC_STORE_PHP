<?php
require_once(__DIR__ . '/header.php');
?>
<div class="title">
  <h1 class="page__ttl">商品検索</h1>
</div>
<form action="product_search.php" method="get" class="form-group form-search">
  <div class="form-group">
    <input type="text" name="keyword" placeholder="　検索したい商品名">
  </div>
  <div class="form-group">
    <button type="submit" value="" class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
    <input type="hidden" name="type" value="product_search">
  </div>
</form>
<div>キーワード：　アンプ　該当件数：4件</div>
<ul class="product">
  <li><a href="product_disp.php" class="item">EVH</br> 5150 III</a></li>
  <li><a href="<?= SITE_URL ?>/product_disp.php" class="item">Marshall</br> JCM900</a></li>
  <li><a href="" class="item">PEAVEY </br>6505</a></li>
  <li><a href="" class="item">MESA BOOGIE</br> recti fire</a></li>
</ul>


<?php
require_once(__DIR__ . '/footer.php');
?>