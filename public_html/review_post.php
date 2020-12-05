<?php
require_once(__DIR__ . '/header.php');
$product_id = $_GET['id'];
$showProductDisp = new Shop\Model\Product();
$product = $showProductDisp->productShow($product_id);
?>
<div class="container">
  <div class="title">
    <h1 class="page__ttl">レビュー投稿</h1>
  </div>
  <form action="review_post_confirm.php" method="post" id="" class="form review-form">
    <div class="form-group">
      <table>
        <tr class="first_tr">
          <th class="t_head" colspan="2">
            <p>レビュー中の商品</p>
          </th>
        </tr>
        <tr>
          <td>
            <img class="imgarea" src="./gazou/<?= h($product->image)?>">
          </td>
          <td>
          <p><?= h($product->maker); ?></p>
          <p><?= h($product->product_name); ?></p>
          </td>
        </tr>
      </table>
      <label>評価</label>
      <select name="hyouka" class="form-control">
        <option value="" disabled selected>選んでください</option>
        <option value="★★★★★">★★★★★</option>
        <option value="★★★★">★★★★</option>
        <option value="★★★">★★★</option>
        <option value="★★">★★</option>
        <option value="★">★</option>
      </select>
    </div>
    <div class="form-group">
      <label>レビュー</label>
      <textarea name="content" class="form-control" placeholder="レビュー内容" rows="10" value=""></textarea>
    </div>
    <input type="submit" class="btn btn-primary review-btn" value="送信する">
    <input type="hidden" name="userid" value="<?= h($_SESSION['me']->id); ?>">
    <input type="hidden" name="productid" value="<?= h($product_id); ?>">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
</div><!-- container -->
<?php require_once(__DIR__ . '/footer.php'); ?>