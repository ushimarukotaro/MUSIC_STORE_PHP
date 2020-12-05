<?php
require_once(__DIR__ . '/header.php');
$signupCon = new Shop\Controller\Signup();
$signupCon->run();
$prefectures = $signupCon->getPrefecture();
?>
<div class="title">
  <h1 class="page__ttl">ユーザー新規登録</h1>
</div>
<form action="" method="post" id="signup" class="form mypage-form">
  <div class="form-group">
    <label>ユーザー名</label>
    <input type="text" name="username" value="<?= isset($signupCon->getValues()->username) ? h($signupCon->getValues()->username) : ''; ?>" class="form-control">
    <p class="err"><?= h($signupCon->getErrors('username')) ?></p>
  </div>
  <div class="form-group">
    <label>メールアドレス</label>
    <input type="text" name="email" value="<?= isset($signupCon->getValues()->email) ? h($signupCon->getValues()->email) : ''; ?>" class="form-control">
    <p class="err"><?= h($signupCon->getErrors('email')) ?></p>
  </div>
  <div class="form-group">
    <label>郵便番号</label>
    〒<input type="text" name="zip1" value="<?= isset($signupCon->getValues()->zip1) ? h($signupCon->getValues()->zip1) : ''; ?>" class="form-control" style="width: 5rem; display: inline-block;" onKeyUp="AjaxZip3.zip2addr('zip1', 'zip2', 'prefecture_id', 'address2');" /> -
    <input type="text" name="zip2" value="<?= isset($signupCon->getValues()->zip2) ? h($signupCon->getValues()->zip2) : ''; ?>" class="form-control" style="width: 8rem; display: inline-block;" onKeyUp="AjaxZip3.zip2addr('zip1', 'zip2', 'prefecture_id', 'address2');" />
    <p class="err"><?= h($signupCon->getErrors('zip1')) ?></p>
    <p class="err"><?= h($signupCon->getErrors('zip2')) ?></p>
  </div>
  <div class="form-group">
    <label>住所</label>
    <div class="form-city">都道府県</div>
    <select name="prefecture_id">
      <option value="" selected disabled>-- 選択してください --</option>
      <?php foreach($prefectures as $prefecture) : ?>
        <option value="<?= $prefecture->id ?>" <?= array_key_exists('prefecture_id', $_POST) && $_POST['prefecture_id'] == $prefecture->id ? 'selected' : ''; ?>><?= $prefecture->prefecture_name ?></option>
      <?php endforeach ; ?>
    </select>
    <div class="form-city"></div>
    <input type="text" name="address2" placeholder="市区町村　番地　建物名　部屋番号 etc" value="<?= isset($signupCon->getValues()->address2) ? h($signupCon->getValues()->address2) : ''; ?>" class="form-control">
    <p class="err"><?= h($signupCon->getErrors('address2')) ?></p>
  </div>
  <div class="form-group">
    <label>パスワード</label>
    <input type="password" name="password" class="form-control">
    <p class="err"><?= h($signupCon->getErrors('password')) ?></p>
  </div>
  <button class="btn btn-primary signup-btn" onclick="document.getElementById('signup').submit();">登録</button>
  <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
</form>
<p class="fs12 signup-p"><a href="<?= SITE_URL; ?>/login.php">ログイン</a></p>
<!-- container -->
<?php require_once(__DIR__ . '/footer.php'); ?>