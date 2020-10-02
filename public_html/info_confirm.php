<?php
require_once(__DIR__ . '/header.php');
?>
<div class="title">
  <h1 class="page__ttl">問合せ確認</h1>
</div>
<form class="form" method="post" action="info_done.php">
  <table class="review_table">
    <tbody>
      <tr>
        <th>お名前</th>
        <td>山田　太一</td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>test@test.com</td>
      </tr>
      <tr>
        <th>問合せ内容</th>
        <td>
        テキストテキストテキストテキストテキストテキスト
        テキストテキストテキストテキストテキストテキスト
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
