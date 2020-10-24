<?php
require_once(__DIR__ . '/header.php');
$app = new Shop\Controller\UserUpdate();
$app->run();
$signupCon = new Shop\Controller\Signup();
$prefectures = $signupCon->getPrefecture();
var_dump($_SESSION['me']);
?>
<div class="title">
  <h1 class="page__ttl">マイページ</h1>
</div>
<div class="container">
  <form action="user_update_done.php" method="post" id="userupdate" class="form mypage-form row" enctype="multipart/form-data">
    <div class="col-md-8">
      <div class="form-group">
        <label>メールアドレス</label>
        <input type="text" name="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>" class="form-control">
        <p class="err"><?= h($app->getErrors('email')); ?></p>
      </div>
      <div class="form-group">
        <label>ユーザー名</label>
        <input type="text" name="username" value="<?= isset($app->getValues()->username) ? h($app->getValues()->username) : ''; ?>" class="form-control">
        <p class="err"><?= h($app->getErrors('username')) ?></p>
      </div>
      <div class="form-group">
        <label>郵便番号</label>
        <input type="text" name="zip1" value="<?= isset($app->getValues()->zip1) ? h($app->getValues()->zip1) : ''; ?>" class="form-control" style="width: 5rem; display: inline-block;"> -
        <input type="text" name="zip2" value="<?= isset($app->getValues()->zip2) ? h($app->getValues()->zip2) : ''; ?>" class="form-control" style="width: 8rem; display: inline-block;">
        <p class="err"><?= h($app->getErrors('zip1')) ?></p>
        <p class="err"><?= h($app->getErrors('zip2')) ?></p>
      </div>
      <div class="form-group">
        <label>住所</label>
        <div class="form-city">都道府県</div>
        <select name="prefecture_id">
          <option value="" selected disabled>-- 選択してください --</option>
          <?php foreach ($prefectures as $prefecture) : ?>
            <option value="<?= $prefecture->id ?>" <?= $app->getValues()->prefecture_id == $prefecture->id ? 'selected' : '';?>><?= $prefecture->prefecture_name ?></option>
          <?php endforeach; ?>
        </select>
        <div class="form-city">市区町村　建物名　部屋番号</div>
        <input type="text" name="address2" value="<?= isset($app->getValues()->address2) ? h($app->getValues()->address2) : ''; ?>" class="form-control">
        <p class="err"><?= h($app->getErrors('prefecture_id')) ?></p>
        <p class="err"><?= h($app->getErrors('address2')) ?></p>
      </div>
      <button class="btn btn-primary" onclick="document.getElementById('userupdate').submit();">更新</button>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <input type="hidden" name="type" value="userupdate">
      <p class="err"></p>
    </div>
  </form>
  <form class="user-delete" action="user_delete_confirm.php" method="post">
    <input type="submit" class="btn btn-success" value="退会する">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
</div>
<!--container -->
<?php
require_once(__DIR__ . '/footer.php');
?>