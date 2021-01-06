<?php
require_once(__DIR__ . '/header.php');
$adminCon = new Shop\Controller\UserManage();
//$adminCon->run();
$product_id = $_GET['product_id'];
$product = $adminCon->adminDispShow($product_id);
$app = new Shop\Controller\ProductUpdate();
$app->run();
$categories = $app->getCategories();

$getTags = new Shop\Model\Product();
$tagsToProducts = $getTags->getTagsToProduct($product_id);
$tags = $getTags->getTagsAll();
// var_dump($tagsToProducts);
?>
<div class="title">
  <h1 class="page__ttl">商品詳細変更</h1>
</div>
<form id="product_disp_form" action="" method="post" class="create-form" enctype="multipart/form-data">
  <div class="err-area" style="text-align:center;">
    <p class="err"><?= h($app->getErrors('maker')) ?></p>
    <p class="err"><?= h($app->getErrors('product_name')) ?></p>
    <p class="err"><?= h($app->getErrors('price')) ?></p>
    <p class="err"><?= h($app->getErrors('tags')) ?></p>
  </div>
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
              <img src="<?= isset($product->image) ? './gazou/' . $product->image : './asset/img/noimage.jpg' ?>" alt="">
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
          <p class="err"><?= h($app->getErrors('category_id')) ?></p>
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
            <option value="1" <?= $product->delflag == 1 ? 'selected' : ''; ?>>売り切れ</option>
          </select>
        </td>
      </tr>
      <tr>
        <th>
          タグ
          <p style="font-size: 12px;" class="err">＊削除したいタグを選択</p>
        </th>
        <td>
          <div class="form-inline">
            <?php foreach ($tags as $tag) : ?>
              <?php foreach ($tagsToProducts as $ttp) : ?>
                <?php if ($tag->id == $ttp->tag_id) : ?>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="tag_delete[]" class="custom-control-input" id="custom-deltag-<?= $tag->id; ?>" value="<?= $tag->id; ?>">
                    <label class="custom-control-label" for="custom-deltag-<?= $tag->id; ?>"><?= $tag->tag_name; ?></label>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endforeach; ?>
          </div>
        </td>
      </tr>
      <tr>
        <th>
          タグを追加
        </th>
        <td>
          <div class="form-inline">
            <?php foreach ($tags as $tag) : ?>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="tag[]" class="custom-control-input" id="custom-check-<?= $tag->id; ?>" value="<?= $tag->id; ?>">
                <label class="custom-control-label" for="custom-check-<?= $tag->id; ?>"><?= $tag->tag_name; ?></label>
              </div>
            <?php endforeach; ?>
          </div>
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
    <button onclick="document.getElementById('product_disp_form').submit();" class="btn btn-primary">更新</button>
    <input type="button" class="btn btn-outline-primary" onclick="history.back()" value="戻る">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <input type="hidden" name="old_image" value="<?= h($product->image) ?>">
    <input type="hidden" name="id" value="<?= h($product_id) ?>">
    <input type="hidden" name="type" value="productupdate">
  </div>
</form>

<?php
require_once(__DIR__ . '/footer.php');
