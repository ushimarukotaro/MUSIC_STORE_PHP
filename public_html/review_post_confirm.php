<?php
require_once(__DIR__ . '/header.php');
?>
<div class="title">
  <h1 class="page__ttl">商品新規登録画面</h1>
</div>
<form class="form" method="post" action="review_post_done.php">
  <table class="review_table">
    <tbody>
      <tr>
        <th>評価</th>
        <td>★★★</td>
      </tr>
      <tr>
        <th>ユーザー名</th>
        <td>hogehoge</td>
      </tr>
      <tr>
        <th>レビュー内容</th>
        <td>
          よかったよかった。なぜならよかったから
          よかったよかった。なぜならよかったから
          よかったよかった。なぜならよかったから
          よかったよかった。なぜならよかったから
        </td>
      </tr>
    </tbody>
  </table>
  <p class="review_confirm_p">上記の内容で投稿しますか？</p>
  <input type="submit" name="review" class="btn btn-primary review-btn">
  <input type="button" onclick="history.back()" value="戻る" class="btn btn-primary review-btn">
</form>
<?php
require_once(__DIR__ . '/footer.php');
