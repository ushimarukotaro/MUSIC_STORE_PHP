<?php
require_once(__DIR__ . '/header.php');
$adminCon = new Shop\Controller\UserManage();
//$adminCon->run();
$product = $adminCon->adminDispShow();
var_dump($product);
?>
<div class="title">
  <h1 class="page__ttl">商品詳細変更</h1>
</div>

<form action="" method="post" class="create-form">
  <table class="create-table">
    <tbody>
      <tr>
        <th>
          商品画像
        </th>
        <td class="imgarea">
          <img src="./gazou/<?= h($_POST['image']) ?>" alt="">
        </td>
      </tr>
      <tr>
        <th>
          メーカー
        </th>
        <td>
            <input type="maker" class="form-control" value="<?= h($_POST[$products['maker']]) ?>">
        </td>
      <tr>
      <tr>
        <th>
          商品名
        </th>
        <td>
          <input type="maker" class="form-control" value="<?= h($_POST['product_name' . $_POST['id']]) ?>">
        </td>
      <tr>
        <th>
          カテゴリー
        </th>
        <td>
          
        </td>
      </tr>
      <tr>
        <th>
          値段
        </th>
        <td>
          
        </td>
      </tr>
      <tr>
        <th>
          説明文
        </th>
        <td>
          
        </td>
      </tr>
    </tbody>
  </table>
  <input type="submit" class="btn btn-primary" value="変更">
  <input type="button" class="btn btn-primary" onclick="history.back()" value="戻る">
  <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  <input type="hidden" name="product_name" value="<?= h($_POST['product_name']); ?>">
  <input type="hidden" name="maker" value="<?= h($_POST['maker']); ?>">
  <input type="hidden" name="price" value="<?= h($_POST['price']); ?>">
  <input type="hidden" name="category" value="<?= h($_POST['category']); ?>">
  <input type="hidden" name="details" value="<?= h($_POST['details']); ?>">
  <input type="hidden" name="image" value="<?= h($_FILES['image']); ?>">
</form>

<?php
require_once(__DIR__ . '/footer.php');
