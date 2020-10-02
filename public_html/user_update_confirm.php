<?php
require_once(__DIR__ .'/header.php');
?>
<div class="title">
  <h1 class="page__ttl">ユーザー情報更新</h1>
</div>
  <p class="user-disp">以下のユーザー情報を更新します。実行する場合は「更新」ボタンを押してください。</p>
  <div class="container">
      <div class="form-group">
        <p>メールアドレス：test@test.com</p>
      </div>
      <div class="form-group">
        <p>ユーザー名：テスト田テス斗</p>
      </div>
    <form class="user-confirm" action="user_update_done.php" method="post">
      <a class="btn btn-primary" href="javascript:history.back();">戻る</a>
      <input type="submit" class="btn btn-primary" value="更新">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <input type="hidden" name="type" value="delete">
    </form>
</div><!--container -->
<?php
require_once(__DIR__ .'/footer.php');
?>
