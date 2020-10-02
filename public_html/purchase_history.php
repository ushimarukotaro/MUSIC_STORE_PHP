<?php
require_once(__DIR__ . '/header.php');
?>
<div class="title">
  <h1 class="page__ttl">購入履歴</h1>
</div>
  <form action="product_create_done.php" method="post" class="pro_create_history">
    <table class="table">
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
            購入日：2020/03/20
          </td>
          <td>
            <a href="review_post.php" class="btn-primary">レビュー</a>
          </td>
        </tr>
        <tr>
          <td>
            <img src="" alt="商品画像">
          </td>
          <td>
            ダダリオ
          </td>
          <td>
            ギター弦
          </td>
          <td>
            アクセサリー
          </td>
          <td>
            ¥480
          </td>
          <td>
            購入日：2020/03/04
          </td>
          <td>
            <a href="review_post.php" class="btn-primary">レビュー</a>
          </td>
        </tr>
        <tr>
          <td>
            <img src="" alt="商品画像">
          </td>
          <td>
            Ibaneze
          </td>
          <td>
            TS-808
          </td>
          <td>
            エフェクター
          </td>
          <td>
            ¥12,800
          </td>
          <td>
            購入日：2019/11/22
          </td>
          <td>
            <a href="review_post.php" class="btn-primary">レビュー</a>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
  <a href="product_all.php" class="btn btn-default">商品一覧へ</a>

<?php
require_once(__DIR__ . '/footer.php');
