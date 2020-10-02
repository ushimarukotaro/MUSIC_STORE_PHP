<?php
require_once(__DIR__ .'/header.php');
?>
<div class="title">
  <h1 class="page__ttl">商品追加確認</h1>
</div>
  <p>以下の商品を追加しますか？？</p>
  <form action="product_create_done.php" method="post" class="create-form">
    <table class="table">
      <tbody>
        <tr>
          <th>
            商品画像
          </th>
          <th>
            メーカー
          </th>
          <th>
            商品名
          </th>
          <th>
            カテゴリー
          </th>
          <th>
            値段
          </th>
        </tr>
        <tr>
          <td>
            <img src="" alt="商品画像">
          </td>
          <td>
            ギブソン
          </td>
          <td>
            レスポール
          </td>
          <td>
            ギター
          </td>
          <td>
            ¥200,000
          </td>
        </tr>
      </tbody>
    </table>
    <input type="submit" name="create" class="btn btn-primary" value="商品追加">
    <input type="button" name="create" class="btn btn-primary" onclick="history.back()" value="戻る">
  </form>

<?php
require_once(__DIR__ .'/footer.php');