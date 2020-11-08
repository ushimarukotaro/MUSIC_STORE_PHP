<?php
require_once(__DIR__ . '/header.php');
$favListShow = new Shop\Model\Product();
$products = $favListShow->favProductShowAll();
// var_dump($products);
?>
<div class="title">
  <h1 class="page__ttl">欲しい物リスト</h1>
</div>
<table class="favorite">
  <tbody>
    <?php foreach ($products as $product) : ?>
      <tr>
        <td class="img-area">
          <form id="product_disp" method="get">
            <span class="category_name"><?= h($product->category_name) ?></span>
            <a href="<?= SITE_URL ?>/product_disp.php?id=<?= h($product->p_id) ?>" class="item" onclick="document.getElementById('product_disp').submit"><img src="./gazou/<?= h($product->image); ?>" alt=""></a>
          </form>
        </td>
        <td class="detail-area">
          <p><?= h($product->maker); ?></p>
          <p><?= h($product->product_name); ?></p>
          <p class="err">¥<?= h(number_format($product->price)); ?>（税抜）</p>
          <p>¥<?= h(number_format(floor($product->price * 1.10))); ?>（税込）</p>
        </td>
        <form action="" id="in_or_del" method="post">
          <td class="btn-area">
            <div>
              <input type="submit" formaction="cart_list.php" name="cart_in" class="btn btn-primary" value="カートに入れる">
              <input type="hidden" name="id" value="<?= h($product->p_id) ?>">
              <input type="hidden" name="num" value="1">
            </div>
            <div>
              <button type="submit" formaction="favorite_delete.php" name="fav_delete" class="btn btn-danger">欲しいものから削除</button>
              <input type="hidden" name="product_id" value="<?= h($product->p_id) ?>">
              <input type="hidden" name="user_id" value="<?= h($_SESSION['me']->id) ?>">
              <input type="hidden" name="type" value="fav_delete">
            </div>
          </td>
          <input type="hidden" name="token" value="<?= h($_SESSION['token']) ?>">

        </form>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php
require_once(__DIR__ . '/footer.php');
?>