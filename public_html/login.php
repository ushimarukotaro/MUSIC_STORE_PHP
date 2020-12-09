<?php
require_once(__DIR__ . '/header.php');
$LoginCon = new Shop\Controller\Login();
$LoginCon->run();
?>
<div class="title">
  <h1 class="page__ttl">ログイン</h1>
</div>
  <form action="" method="post" id="login" class="form">
    <div class="form-group">
      <label>メールアドレス</label>
      <input type="text" name="email" value="<?= isset($LoginCon->getValues()->email) ? h($LoginCon->getValues()->email) : ''; ?>" class="form-control">
    </div>
    <div class="form-group">
      <label>パスワード</label>
      <input type="password" name="password" class="form-control">
    </div>
    <p class="err"><?= h($LoginCon->getErrors('login')); ?></p>
    <button class="btn btn-primary signup-btn" onclick="document.getElementById('login').submit();">ログイン</button>
    <input type="hidden" name="token" value="<?= h($_SESSION['token']) ?>">
  </form>
<p class="fs12 signup-p"><a href="signup.php">ユーザー登録</a></p>
<?php require_once(__DIR__ . '/footer.php'); ?>