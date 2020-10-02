<?php
require_once(__DIR__ . '/header.php');
?>
<div class="title">
  <h1 class="page__ttl">カート一覧</h1>
</div>
<form action="purchase_confirm.php" method="post">
  <p class="cart-info">カートの中身：2点</p>
  <table class="favorite">
    <tbody>
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
        <td>
          <input type="submit" formaction="cart_delete.php" name="cart_delete" class="btn-danger" value="カートから削除">
        </td>
      </tr>
      <tr>
        <td>
          <img src="" alt="商品画像">
        </td>
        <td>
          bogner
        </td>
        <td>
          extacy red
        </td>
        <td>
          エフェクター
        </td>
        <td>
          ¥16,800
        </td>
        <td>
          <input type="submit" formaction="cart_delete.php" name="cart_delete" class="btn-danger" value="カートから削除">
        </td>
      </tr>
    </tbody>
  </table>
  <p class="cart-info">小計　¥216,800</p>
  <div class="purchase-btn">
    <input type="submit" name="purchase" class="btn-primary btn" value="購入する">
  </div>
</form>
<?php
require_once(__DIR__ . '/footer.php');
?>