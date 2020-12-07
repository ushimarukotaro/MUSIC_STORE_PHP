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
      <input type="text" name="name" value="<?= isset($_SESSION['me']) ? h($_SESSION['me']->username) : ''; ?>" class="form-control">
    </div>
    <div class="form-group">
      <label>メールアドレス</label>
      <input type="text" name="email" value="<?= isset($_SESSION['me']) ? h($_SESSION['me']->email) : ''; ?>" class="form-control">
    </div>
    <div class="form-group">
      <label>件名</label>
      <input type="text" name="title" value="" class="form-control">
    </div>
    <div class="form-group">
      <label>問合せ内容</label>
      <textarea name="content" class="form-control" rows="10"></textarea>
    </div>
    <input type="submit" class="btn btn-primary review-btn">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
</div><!-- container -->
<?php require_once(__DIR__ . '/footer.php'); ?>