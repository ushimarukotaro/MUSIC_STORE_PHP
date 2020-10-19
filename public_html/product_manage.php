<?php
require_once(__DIR__ . "/header.php");
$adminCon = new Shop\Controller\UserManage();
$adminCon->run();
$products = $adminCon->adminShow();
?>
<div class="title">
  <h1 class="page__ttl">商品管理画面</h1>
</div>
<form action="product_manage_disp.php">
  <div style="margin-bottom: 50px;">
    <a href="product_create.php" class="btn btn-primary">商品新規登録</a>
  </div>
  <p>更新または削除を行う商品を選択してください。</p>
  <table class="admin-table">
    <tbody>
      <tr>
        <th></th>
        <th>画像</th>
        <th>id</th>
        <th>カテゴリー</th>
        <th>商品名</th>
        <th>メーカー</th>
        <th>値段(税抜)</th>
        <th>登録日</th>
      </tr>
      <?php foreach ($products as $product) : ?>
        <tr>
          <td>
            <input type="radio" name="product_id" id="pro_id<?= h($product->id); ?>" value="<?= h($product->id); ?>">
          </td>
          <td>
            <label for="pro_id<?= h($product->id); ?>">
              <img src="./gazou/<?= h($product->image) ?>" alt="">
            </label>
          </td>
          <td>
            <label for="pro_id<?= h($product->id); ?>"><?= h($product->id) ?></label>
          </td>
          <td>
            <label for="pro_id<?= h($product->id); ?>"><?= h($product->category_name) ?></label>
          </td>
          <td>
            <label for="pro_id<?= h($product->id); ?>"><?= h($product->product_name) ?></label>
          </td>
          <td>
            <label for="pro_id<?= h($product->id); ?>"><?= h($product->maker) ?></label>
          </td>
          <td>
            <label for="pro_id<?= h($product->id); ?>">¥<?= h(number_format($product->price)) ?></label>
          </td>
          <td>
            <label for="pro_id<?= h($product->id); ?>"><?= h($product->created) ?></label>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <p class="err"></p>
  <input type="submit" name="update" value="編集" class="btn btn-primary">
  <input type="submit" name="delete" value="削除" class="btn btn-danger">
  <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  <input type="hidden" name="category_id" value="<?= h($_product->category_id); ?>">
</form>

<?php
require_once(__DIR__ . "/footer.php");
