<?php
require_once(__DIR__ . '/header.php');
$adminCon = new Shop\Controller\UserManage();
//$adminCon->run();
$product_id = $_GET['product_id'];
$product = $adminCon->adminDispShow($product_id);
$app = new Shop\Controller\ProductCreate();
$app->run();
$categories = $app->getCategories();
?>
<div class="title">
  <h1 class="page__ttl">商品詳細変更</h1>
</div>

<form action="product_manage_edit_done.php" method="post" class="create-form" enctype="multipart/form-data">
  <table class="create-table">
    <tbody>
      <tr>
        <th class="first_th">
          商品画像
        </th>
        <td>
          <div class="imgarea">
            <label>
              <div class="imgfile">
                <img src="./gazou/<?= h($product->image) ?>" alt="">
              </div>
              <span class="btn-gray file-btn">
                画像を選択してください
                <input type="file" name="image" class="form" style="display:none" accept="image/*">
              </span>
            </label>
          </div>
        </td>
      </tr>
      <tr>
        <th>
          メーカー
        </th>
        <td>
          <input type="text" name="maker" class="form-control" value="<?= h($product->maker) ?>">
        </td>
      <tr>
      <tr>
        <th>
          商品名
        </th>
        <td>
          <input type="text" name="product_name" class="form-control" value="<?= h($product->product_name) ?>">
        </td>
      <tr>
        <th>
          カテゴリー
        </th>
        <td>
          <select class="select form-control" name="category_id">
            <?php foreach ($categories as $category) : ?>
              <option value="<?= $category->id ?>" <?= $category->id == $product->id ? 'selected' : ''; ?>><?= $category->category_name ?></option>
            <?php endforeach; ?>
          </select>
        </td>
      </tr>
      <tr>
        <th>
          値段
        </th>
        <td>
          <input type="text" name="price" class="form-control" value="<?= h($product->price) ?>">
        </td>
      </tr>
      <tr>
        <th>
          削除フラグ
        </th>
        <td>
          <select class="select form-control" name="delflag">
            <option value="0" <?= $product->delflag == 0 ? 'selected' : ''; ?>>表示する</option>
            <option value="1" <?= $product->delflag == 1 ? 'selected' : ''; ?>>削除する</option>
          </select>
        </td>
      </tr>
      <tr>
        <th class="last_th">
          説明文
        </th>
        <td>
          <textarea name="details" class="form-control detail" value="<?= h($product->details) ?>"><?= h($product->details) ?></textarea>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="manage-btn-area">
    <input type="submit" class="btn btn-primary" value="更新">
    <input type="button" class="btn btn-outline-primary" onclick="history.back()" value="戻る">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <input type="hidden" name="old_image" value="<?= h($product->image) ?>">
    <input type="hidden" name="id" value="<?= h($product_id) ?>">
    <input type="hidden" name="type" value="productupdate">
  </div>
</form>

<?php
require_once(__DIR__ . '/footer.php');
