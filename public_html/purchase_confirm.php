<?php
require_once(__DIR__ . '/header.php');
$cart = $_SESSION['cart'];
$num = $_SESSION['num'];
$showUserDate = new Shop\Model\User();
$userDate = $showUserDate->purchaseConfirmUser($_SESSION['me']->id);
$app = new Shop\Controller\CartIn();
?>
<div class="title">

  <h1 class="page__ttl">購入確認</h1>
</div>
<p>以下の商品を購入しますか？？</p>
<p>購入数：<?= count($cart); ?>点</p>
<form action="purchase_done.php" method="post" class="table">
  <div class="conf_wrap">
    <table class="cart-table purchase-table">
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
            <td class="img_area confirm_img">
              <img src="./gazou/<?= h($image[$i]); ?>" alt="">
            </td>
            <td class="detail_area confirm_detail">
              <div><?= h($category_name[$i]); ?></div>
              <div><?= h($maker[$i]); ?></div>
              <div><?= h($pro_name[$i]); ?></div>
              <div class="red">¥<?= h(number_format($price[$i])); ?>（税抜）</div>
              <div>¥<?= h(number_format(floor($price[$i] * 1.1))); ?>（税込）</div>
            </td>
            <td class="submit_area confirm_submit">
              <span class="product-order">
                注文数：<?= $num[$i] ?>
              </span>
              <?php $totalPrice = h(number_format(floor($price[$i] * $num[$i] * 1.1))); ?>
              <p>小計￥<?= $totalPrice; ?>（込）</p>
            </td>
          </tr>
      </tbody>
    <?php endfor; ?>
    </table>
    <div class="address_confirm_area">
      <div class="send_address_show">
        <p><?= h($userDate->username); ?>様</p>
        <p>以下の住所に配達します。</p>
        <p>===================================</p>
        <span>〒<?= h($userDate->zip1); ?> - </span>
        <span><?= h($userDate->zip2); ?></span>
        <p>
          <span><?= h($userDate->prefecture_name); ?></span>
          <span><?= h($userDate->address2); ?></span>
        </p>
        <p>注文を確定すると<?= h($userDate->email); ?>宛に自動でメールが送信されますのでご確認ください。</p>
      </div>
    </div>
  </div>
  <div class="price_area">
    <p class="confirm-price">合計　¥<?= $app->showSubTotal(); ?>（税込）</p>
  </div>
  <input type="submit" name="create" class="btn btn-primary" value="購入を確定">
  <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  <input type="hidden" name="pro_id" value="<?= h($pro_id); ?>">
  <input type="hidden" name="num" value="<?= $_SESSION['num']; ?>">
</form>
<button class="btn btn-outline-primary" onclick="history.back()">戻る</button>
<?php
require_once(__DIR__ . '/footer.php');
