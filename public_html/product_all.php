<?php
require_once(__DIR__ . '/header.php');
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
<ul class="product">
  <li><a href="product_disp.php" class="item">item1</a></li>
  <li><a href="<?= SITE_URL ?>/product_disp.php" class="item">item2</a></li>
  <li><a href="" class="item">item3</a></li>
  <li><a href="" class="item">item4</a></li>
  <li><a href="" class="item">item5</a></li>
  <li><a href="" class="item">item6</a></li>
  <li><a href="" class="item">item7</a></li>
  <li><a href="" class="item">item8</a></li>
  <li><a href="" class="item">item9</a></li>
  <li><a href="" class="item">item10</a></li>
  <li><a href="" class="item">item11</a></li>
  <li><a href="" class="item">item12</a></li>
  <li><a href="" class="item">item13</a></li>
  <li><a href="" class="item">item14</a></li>
</ul>
<?php
require_once(__DIR__ . '/footer.php');
