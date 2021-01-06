<?php
require_once(__DIR__ . "/header.php");
$app = new Shop\Controller\ProductCreate();
$app->run();
$categories = $app->getCategories();
?>
<div class="title">
  <h1 class="page__ttl">商品新規登録画面</h1>
</div>
<div class="container">
  <p>権限：1=一般ユーザー、99=管理者</p>
  <form action="product_create.php" method="post" id="userupdate" class="form pro_form" enctype="multipart/form-data">
    <div class="pro_update">
      <div class="form-group edit-img col-md-4">
        <div class="imgarea ">
          <label>
            <span class="btn-gray file-btn">
              画像を選択
              <input type="file" name="image" class="form" style="display:none" accept="image/*">
            </span>
            <div class="imgfile">
              <img src="<?= isset($app->getValues()->image) ? './gazou/' . h($app->getValues()->image) : './asset/img/noimage.jpg'; ?>" alt="">
            </div>
          </label>
        </div>
      </div>
      <div class="col-md-10 pro-create">
        <div class="form-group">
          <label>商品名
            <input type="text" name="product_name" value="<?= isset($app->getValues()->product_name) ? h($app->getValues()->product_name) : ''; ?>" class="form-control">
          </label>
          <p class="err"><?= h($app->getErrors('product_name')) ?></p>
        </div>
        <div class="form-group">
          <label>メーカー
            <input type="text" name="maker" value="<?= isset($app->getValues()->maker) ? h($app->getValues()->maker) : ''; ?>" class="form-control">
          </label>
          <p class="err"><?= h($app->getErrors('maker')) ?></p>
        </div>
        <div class="form-group">
          <label>カテゴリー</label>
          <select name="category_id" class="form-control" style="width: 60%;">
            <option value="" selected disabled>-- 選択してください --</option>
            <?php foreach ($categories as $category) : ?>
              <option value="<?= $category->id ?>" <?= array_key_exists('category_id', $_POST) && $_POST['category_id'] == $category->id ? 'selected' : ''; ?>><?= $category->category_name ?></option>
            <?php endforeach; ?>
          </select>
          <p class="err"><?= h($app->getErrors('category_id')) ?></p>
        </div>
        <div class="form-group">
          <label>値段
            <input type="text" name="price" value="<?= isset($app->getValues()->price) ? h($app->getValues()->price) : ''; ?>" class="form-control">
          </label>
          <p class="err"><?= h($app->getErrors('price')) ?></p>
        </div>
        <div class="form-group">
          <label>商品説明</label>
          <textarea name="details" class="form-control" value="<?= isset($app->getValues()->product_details) ? h($app->getValues()->product_details) : ''; ?>" placeholder="商品説明" rows="14"></textarea>
          <p class="err"><?= h($app->getErrors('details')) ?></p>
        </div>
      </div>
    </div>
    <div class="btn-area">
      <input type="submit" class="btn btn-primary btn-lg" value="登録">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <a href="<?= SITE_URL ?>/product_manage.php" onclick="history.back()" class="btn btn-outline-primary bt-sm">戻る</a>
    </div>

  </form>
</div> <!--  container  -->

<?php
require_once(__DIR__ . "/footer.php");
?>