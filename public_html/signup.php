<?php
require_once(__DIR__ . '/header.php');

?>
<div class="title">
  <h1 class="page__ttl">ユーザー新規登録</h1>
</div>
<form action="" method="post" id="signup" class="form mypage-form">
  <div class="form-group">
    <label>メールアドレス</label>
    <input type="text" name="email" value="" class="form-control">
    <p class="err"></p>
  </div>
  <div class="form-group">
    <label>ユーザー名</label>
    <input type="text" name="username" value="" class="form-control">
    <p class="err"></p>
  </div>
  <div class="form-group">
    <label>郵便番号</label>
    <input type="text" name="postal1" value="" class="form-control" style="width: 5rem; display: inline-block;"> -
    <input type="text" name="postal2" value="" class="form-control" style="width: 8rem; display: inline-block;">
    <p class="err"></p>
  </div>
  <div class="form-group">
    <label>住所</label>
    <div class="form-city">都道府県</div>
    <select name="prefecture">
      <option disabled selected>選択してください</option>
      <option value="北海道">北海道</option>
      <option value="東京">東京</option>
      <option value="名古屋">名古屋</option>
      <option value="大阪">大阪</option>
      <option value="福岡">福岡</option>
    </select>
    <div class="form-city">区長村　建物名　部屋番号</div>
    <input type="text" name="address" value="" class="form-control">
    <p class="err"></p>
  </div>
  <div class="form-group">
    <label>パスワード</label>
    <input type="password" name="password" class="form-control">
    <p class="err"></p>
  </div>
  <button class="btn btn-primary signup-btn" onclick="document.getElementById('signup').submit();">登録</button>
  <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
</form>
<p class="fs12 signup-p"><a href="<?= SITE_URL; ?>/login.php">ログイン</a></p>
<!-- container -->
<?php require_once(__DIR__ . '/footer.php'); ?>