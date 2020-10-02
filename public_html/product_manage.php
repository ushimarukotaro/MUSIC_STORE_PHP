<?php
require_once(__DIR__ . "/header.php");
?>
<div class="title">
  <h1 class="page__ttl">商品管理画面</h1>
</div>
  <form action="" method="post">
    <div style="margin-bottom: 50px;">
      <a href="product_create.php" class="btn btn-primary">商品新規登録へ</a>
    </div>
    <p>更新または削除を行う商品を選択してください。</p>
    <table class="table">
      <tbody>
        <tr>
          <th></th>
          <th>id</th>
          <th>商品名</th>
          <th>値段</th>
          <th>商品画像</th>
        </tr>
        <tr>
          <td>
            <input type="radio" name="id" value="">
          </td>
          <td>
            1
          <td>
            <input type="text" name="name" value="ギター">
          </td>
          <td>
            ￥<input type="text" name="price" value="58000">
          </td>
          <td>
            <input type="text" name="image" value="icon.img">
          </td>
        </tr>
      </tbody>
    </table>
    <p class="err"></p>
    <input type="submit" name="update" value="更新" class="btn btn-primary">
    <input type="submit" name="delete" value="削除" class="btn btn-primary">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>

<?php
require_once(__DIR__ . "/footer.php");
