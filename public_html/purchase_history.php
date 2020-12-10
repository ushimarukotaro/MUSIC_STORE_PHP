<?php
require_once(__DIR__ . '/header.php');
$showHistories = new Shop\Model\Product();
$products = $showHistories->showPurchaseHistory($_SESSION['me']->id);
$histories = $showHistories->getHistories($_SESSION['me']->id);
// var_dump($histories);
?>
<div class="title">
  <h1 class="page__ttl">購入履歴</h1>
</div>

<?php foreach ($histories as $history) : ?>
  <table class="table favorite hist">
    <tbody>
      <tr class="hist_first_tr">
        <th class="purchase-day t_head" colspan="3">
          <span>購入日：<?= h(substr($history->h_created, 0, 11)) ?></span>
          <span>　　購入数：<?= h($history->h_id) ?>点</span>
        </th>
      </tr>
      <?php foreach ($products as $product) : ?>
        <?php if ($history->h_created == $product->h_created) : ?>
          <tr>
            <td class="img-area">
              <form id="product_disp" method="get">
                <a href="<?= SITE_URL ?>/product_disp.php?id=<?= h($product->p_id) ?>" class="item" onclick="document.getElementById('product_disp').submit"><img src="./gazou/<?= h($product->image); ?>" alt=""></a>
              </form>
            </td>
            <td class="detail-area">
              <p><?= h($product->maker); ?></p>
              <p><?= h($product->product_name); ?></p>
              <p class="err">¥<?= h(number_format($product->price)); ?>（税抜）</p>
              <p>¥<?= h(number_format(floor($product->price * 1.10))); ?>（税込）</p>
            </td>
            <form id="review" method="get" action="<?= SITE_URL ?>/review_post.php?id=<?= h($product->id) ?>">
              <td>
                <button class="btn btn-primary" onclick="document.getElementById('review').submit()">レビューを投稿</button>
                <input type="hidden" name="id" value="<?= h($product->p_id) ?>">
                <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
              </td>
            </form>
          </tr>
          <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
  </table>
<?php endforeach; ?>

<a href="product_all.php" class="btn btn-link">商品一覧へ</a>

<?php
require_once(__DIR__ . '/footer.php');
