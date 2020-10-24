<?php
require_once(__DIR__ . '/header.php');
$adminCon = new Shop\Controller\UserManage();
$product_id = $_GET['product_id'];
$product = $adminCon->adminDispShow($product_id);
// var_dump($product);
?>
<div class="title">
  <h1 class="page__ttl">商品削除確認</h1>
</div>
<p class="user-disp">以下の商品を削除します。よろしいですか？？</p>
<div class="container">
  <div class="form-group">
    <p>商品ID：<?= h($product_id); ?></p>
  </div>
  <div class="form-group">
    <p>ジャンル：<?= h($product->category_name); ?></p>
  </div>
  <div class="form-group">
    <p>メーカー：<?= h($product->maker); ?></p>
  </div>
  <div class="form-group">
    <p>商品名：<?= h($product->product_name); ?></p>
  </div>
  <div class="form-group">
    <p>値段：<?= h($product->price); ?></p>
  </div>
  <form class="user-delete user-confirm" action="product_delete_done.php" method="post">
    <a class="btn btn-outline-primary" href="javascript:history.back();">戻る</a>
    <input type="submit" class="btn btn-danger" value="削除">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <input type="hidden" name="delete" value="delete">
    <input type="hidden" name="product_id" value="<?= h($product_id) ?>">
  </form>
</div>
<!--container -->
<?php
require_once(__DIR__ . '/footer.php');
?>