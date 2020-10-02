<?php
require_once(__DIR__ . '/header.php');
?>
<div class="title">
  <h1 class="page__ttl">欲しい物リスト</h1>
</div>
<form action="cart_list.php" method="post">
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
          <input type="submit" name="cart_in" class="btn-primary" value="カートに入れる">
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
          <input type="submit" name="cart_in" class="btn-primary" value="カートに入れる">
        </td>
      </tr>
    </tbody>
  </table>
</form>
<?php
require_once(__DIR__ . '/footer.php');
?>