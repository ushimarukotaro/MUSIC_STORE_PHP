<?php
require_once(__DIR__ . '/header.php');

?>
<div class="container">
  <div class="title">
    <h1 class="page__ttl">レビュー投稿</h1>
  </div>
  <form action="review_post_confirm.php" method="post" id="" class="form">
    <div class="form-group">
      <label>評価</label>
      <select name="hyouka" class="form-control">
        <option value="" disabled selected>選んでください</option>
        <option value="5">★★★★★</option>
        <option value="4">★★★★</option>
        <option value="3">★★★</option>
        <option value="2">★★</option>
        <option value="1">★</option>
      </select>
      <p class="err"></p>
    </div>
    <div class="form-group">
      <label>ユーザー名</label>
      <p>hogehoge</p>
      <p class="err"></p>
    </div>
    <div class="form-group">
      <label>レビュー</label>
      <textarea name="review" class="form-control" placeholder="レビュー内容" rows="10"></textarea>
      <p class="err"></p>
    </div>
    <input type="submit" name="review" class="btn btn-primary review-btn">
    
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
</div><!-- container -->
<?php require_once(__DIR__ . '/footer.php'); ?>