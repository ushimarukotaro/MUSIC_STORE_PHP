<?php
require_once(__DIR__ . '/header.php');
$app = new Shop\Controller\CartIn();
$app->run();
?>
<div class="title">
  <h1 class="page__ttl">カート一覧</h1>
</div>
<?php if (count($_SESSION['cart']) == 0) : ?>
  <p>カートの中身は空です</p>
  <a href="<?= SITE_URL ?>/product_all.php" class="btn btn-link">戻る</a>
<?php else : ?>
  <p class="cart-info">カートの中身：<?= count($_SESSION['cart']); ?>点</p>
  <table class="cart-table">
    <?php for($i = 0;$i < count($_SESSION['cart']);$i ++) : ?>
      <tbody>
        <tr>
          <td class="img_area">
            <img src="./gazou/<?= $image[$i]; ?>" alt="">
          </td>
          <td class="detail_area">
            <p><?= h($maker[$i]); ?></p>
            <p><?= h($name[$i]); ?></p>
            <p><?= h($category[$i]); ?></p>
            <p class="red"><?= h($price[$i]); ?>（税抜）</p>
            <p><?= h(number_format(floor($price[$i] * 1.1))); ?>（税込）</p>
          </td>
          <td class="submit_area">
            <form action="num_change.php" method="post">
              <span class="product-order">
                注文数：<input type="text" name="num" value="<?= h($_POST['num']); ?>" maxlength="2" oninput="value = value.replace(/[^0-9]+/i,'');">
              </span>
              <input type="submit" name="re_calc" value="数量変更" class="btn btn-secondary btn-sm">
            </form>
            <form action="cart_delete.php" method="post">
              <input type="submit" name="cart_delete" class="btn btn-danger" value="カートから削除">
            </form>
          </td>
        </tr>
      </tbody>
    <?php endfor ?>
  </table>
  <p class="cart-info">小計　¥216,800</p>
  <form action="cart_delete_all.php" class="cart_all_delete">
      <input type="submit" class="btn btn-dark" value="カートの中を全削除">
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