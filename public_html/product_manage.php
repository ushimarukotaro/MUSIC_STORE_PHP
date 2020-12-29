<?php
require_once(__DIR__ . "/header.php");
$adminCon = new Shop\Controller\UserManage();
$adminCon->run();
$products = $adminCon->adminShow();
$searchProductsCon = new Shop\Controller\ProductSearch();
if (isset($_GET['keyword'])) {
  $products = $searchProductsCon->run();
}
if (isset($_GET['i_get_c'])) {
  $products = $searchProductsCon->run();
}
$createTag = new Shop\Controller\CreateTag();  //タグを作る
$createTag->run();
?>
<div class="title">
  <h1 class="page__ttl">商品管理画面</h1>
  <div class="form-inline insert__tag">
    <form action="" id="create_tag" method="post">
      <span>タグを作る</span>
      <input type="text" class="form-control" name="tag_name" value="">
      <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
      <input type="hidden" name="type" value="create_tag">
      <input type="button" value="登録" class="btn btn-primary" onclick="document.getElementById('create_tag').submit();">
      <p class="err"><?= h($createTag->getErrors('tag_name')); ?></p>
    </form>
  </div>
</div>
<p>更新または削除を行う商品を選択してください。</p>
<div class="create-or-search">
  <a href="product_create.php" class="btn btn-primary">商品新規登録</a>
  <div class="form-group">
    <form id="category" action="">
      <select name="select" class="select sort form-control" onchange="selectCategory();">
        <option selected disabled>ジャンルで絞る</option>
        <option value="ギター">ギター</option>
        <option value="ベース">ベース</option>
        <option value="ドラム">ドラム</option>
        <option value="キーボード">キーボード</option>
        <option value="マイク">マイク</option>
        <option value="アンプ">アンプ</option>
        <option value="エフェクター">エフェクター</option>
        <option value="アクセサリー">アクセサリー</option>
      </select>
    </form>
  </div>
  <form id="search" action="product_manage.php" method="get" class="form-group form-search">
    <div class="form-group">
      <input type="text" name="keyword" class="form-control" placeholder="　絞り込み" value="<?= isset($searchProductsCon->getValues()->keyword) ? h($searchProductsCon->getValues()->keyword) : ''; ?>">
    </div>
    <p class="err"><?= h($adminCon->getErrors('keyword')); ?></p>
    <div class="form-group">
      <button type="submit" value="" class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
      <input type="hidden" name="type" value="product_search">
    </div>
  </form>
</div>
<form action="">
  <table id="fav-table" class="admin-table table">
    <thead>
      <tr class="table-title" style="background: 4fc0f5cc;">
        <th></th>
        <th id="table-img">画像</th>
        <th>id</th>
        <th>カテゴリー</th>
        <th>商品名</th>
        <th>メーカー</th>
        <th>値段(税抜)</th>
        <th>登録日</th>
      </tr>
    </thead>
    <tbody id="tbody">
      <?php foreach ($products as $product) : ?>
        <tr class="admin-td">
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
            <?php if ($product->delflag != "0") : ?>
              <p class="err">削除済</p>
            <?php endif; ?>
          </td>
          <td>
            <label for="pro_id<?= h($product->id); ?>"><?= h($product->maker) ?></label>
          </td>
          <td>
            <label for="pro_id<?= h($product->id); ?>">¥<?= h(number_format($product->price)) ?></label>
          </td>
          <td>
            <label for="pro_id<?= h($product->id); ?>"><?= h(substr($product->created,0,11)) ?></label>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <p class="err"></p>
  <input type="submit" formaction="product_manage_disp.php" name="update" value="編集" class="btn btn-primary">
  <input type="submit" formaction="product_delete_confirm.php" name="delete" value="削除" class="btn btn-danger">
  <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  <input type="hidden" name="id" value="<?= h($_product->id); ?>">
  <input type="hidden" name="category_id" value="<?= h($_product->category_id); ?>">
</form>

<?php
require_once(__DIR__ . "/footer.php");
