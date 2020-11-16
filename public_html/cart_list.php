<?php
require_once(__DIR__ . '/header.php');
$app = new Shop\Controller\CartIn();
$app->run();
$cart = $_SESSION['cart'];
$num = $_SESSION['num'];
?>
<div class="title">
  <h1 class="page__ttl">カート一覧</h1>
</div>
<?php if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) : ?>
  <div class="empty-cart">
    <p>カートの中身は空です</p>
    <a href="<?= SITE_URL ?>/product_all.php" class="btn btn-link">戻る</a>
  </div>
<?php else : ?>
  <p class="cart-info">カートの中身：<?= count($_SESSION['cart']); ?>点</p>
  <form id="num_change" action="num_change.php" method="post">
    <table class="cart-table">
      <tbody>
        <?php foreach ($cart as $key => $value) {
          $cartDisplay = new Shop\Model\Product();
          $res = $cartDisplay->cartProducts($value);

          $pro_id[] = $res['p_id'];
          $pro_name[] = $res['product_name'];
          $price[] = $res['price'];
          $maker[] = $res['maker'];
          $category_name[] = $res['category_name'];
          $image[] = $res['image'];
        } ?>

        <?php for ($i = 0; $i < count($cart); $i++) : ?>
          <tr>
            <td class="img_area">
              <img src="./gazou/<?= h($image[$i]); ?>" alt="">
            </td>
            <td class="detail_area">
              <div><?= h($category_name[$i]); ?></div>
              <div><?= h($maker[$i]); ?></div>
              <div><?= h($pro_name[$i]); ?></div>
              <div class="red">¥<?= h(number_format($price[$i])); ?>（税抜）</div>
              <div>¥<?= h(number_format(floor($price[$i] * 1.1))); ?>（税込）</div>
            </td>
            <td class="submit_area">
              <span class="product-order">
                注文数：<input type="text" name="num<?= $i; ?>" value="<?= h($num[$i]); ?>" maxlength="2" oninput="value = value.replace(/[^0-9]+/i,'');">
              </span>
              <?php $totalPrice = h(number_format(floor($price[$i] * $num[$i] * 1.1))); ?>
              <p><?= $totalPrice; ?>（込）</p>
              <input type="hidden" name="type" value="num_change">
              <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
  <form action="cart_delete.php" method="post">
    <input type="submit" name="cart_delete" class="btn btn-danger" value="カートから削除">
    <input type="hidden" name="del_id<?= $i ?>" value="<?= $i ?>">
    <input type="hidden" name="type" value="cart_delete">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
  </td>
  </tr>
<?php endfor; ?>
</tbody>
</table>

<input type="button" value="数量変更" class="btn btn-success" onclick="document.getElementById('num_change').submit();">
<p class="cart-info total-price">合計　¥<?= $app->showSubTotal(); ?>（税込）</p>

<form id="cart_all_delete" action="cart_delete_all.php" class="cart_all_delete">
  <input type="button" class="btn btn-dark" value="カートを空にする" onclick="cartAllDelete();">
</form>
<form action="purchase_confirm.php" id="cart_in" method="post">
  <div class="submit_btn_area">
    <span class="purchase-btn">
      <button class="btn-primary btn btn-purchase" onclick="document.getElementById('cart_in').submit();">購入する</button>
    </span>
    <span class="purchase-btn">
      <a class="btn btn-outline-primary" href="javascript:history.back();">戻る</a>
    </span>
  </div>
</form>
<?php endif; ?>
<?php
require_once(__DIR__ . '/footer.php');
?>