<?php
require_once(__DIR__ . '/header.php');

?>
<div class="container">
  <div class="title">
    <h1 class="page__ttl">メール問合せ</h1>
  </div>
  <form action="info_confirm.php" method="post" id="" class="form">
    <div class="form-group">
      <label>お名前</label>
      <input type="name" value="" class="form-control" placeholder="山田　一郎">
      <p class="err"></p>
    </div>
    <div class="form-group">
      <label>メールアドレス</label>
      <input type="email" value="" class="form-control" placeholder="sample@sample.com">
      <p class="err"></p>
    </div>
    <div class="form-group">
      <label>件名</label>
      <input type="title" value="" class="form-control" placeholder="件名">
      <p class="err"></p>
    </div>
    <div class="form-group">
      <label>問合せ内容</label>
      <textarea name="review" class="form-control" placeholder="問合せ内容" rows="10"></textarea>
      <p class="err"></p>
    </div>
    <input type="submit" name="review" class="btn btn-primary review-btn">
    
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
</div><!-- container -->
<?php require_once(__DIR__ . '/footer.php'); ?>