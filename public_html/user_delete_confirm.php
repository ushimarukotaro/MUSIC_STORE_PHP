<?php
require_once(__DIR__ .'/header.php');
?>
<h1 class="page__ttl">ユーザー退会</h1>
<p class="user-disp">以下のユーザーを退会します。実行する場合は「退会」ボタンを押してください。</p>
<div class="container">
    <div class="form-group">
      <p>メールアドレス：test@test.com</p>
    </div>
    <div class="form-group">
      <p>ユーザー名：テスト田テス斗</p>
    </div>
  <form class="user-delete user-confirm" action="user_delete_done.php" method="post">
    <a class="btn btn-primary" href="javascript:history.back();">まだしません。</a>
    <input type="submit" class="btn btn-primary" value="退会">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <input type="hidden" name="type" value="delete">
  </form>
</div><!--container -->
<?php
require_once(__DIR__ .'/footer.php');
?>
