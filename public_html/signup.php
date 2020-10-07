<?php
require_once(__DIR__ . '/header.php');
$signupCon = new Shop\Controller\Signup();
$signupCon->run();
?>
<div class="title">
  <h1 class="page__ttl">ユーザー新規登録</h1>
</div>
<form action="" method="post" id="signup" class="form mypage-form">
  <div class="form-group">
    <label>ユーザー名</label>
    <input type="text" name="username" value="<?= isset($signupCon->getValues()->username) ? h($signupCon->getValues()->username) : ''; ?>" class="form-control" placeholder="佐藤太郎">
    <p class="err"><?= h($signupCon->getErrors('username')) ?></p>
  </div>
  <div class="form-group">
    <label>メールアドレス</label>
    <input type="text" name="email" value="<?= isset($signupCon->getValues()->email) ? h($signupCon->getValues()->email) : ''; ?>" class="form-control" placeholder="sample@sample.com">
    <p class="err"><?= h($signupCon->getErrors('email')) ?></p>
  </div>
  <div class="form-group">
    <label>郵便番号</label>
    〒<input type="text" name="zip1" placeholder="123" value="<?= isset($signupCon->getValues()->zip1) ? h($signupCon->getValues()->zip1) : ''; ?>" class="form-control" style="width: 5rem; display: inline-block;" onKeyUp="AjaxZip3.zip2addr('zip1', 'zip2', 'address', 'addresss');" /> -
    <input type="text" name="zip2" placeholder="4567" value="<?= isset($signupCon->getValues()->zip2) ? h($signupCon->getValues()->zip2) : ''; ?>" class="form-control" style="width: 8rem; display: inline-block;" onKeyUp="AjaxZip3.zip2addr('zip1', 'zip2', 'address', 'address');" />
    <p class="err"><?= h($signupCon->getErrors('zip1')) ?></p>
    <p class="err"><?= h($signupCon->getErrors('zip2')) ?></p>
  </div>
  <div class="form-group">
    <label>住所</label>
    <!-- <div class="form-city">都道府県</div>
    <select name="address1">
            <option value="">-- 選択してください --</option>
            <option value="01">北海道</option>
            <option value="02">青森県</option>
            <option value="03">岩手県</option>
            <option value="04">宮城県</option>
            <option value="05">秋田県</option>
            <option value="06">山形県</option>
            <option value="07">福島県</option>
            <option value="08">茨城県</option>
            <option value="09">栃木県</option>
            <option value="10">群馬県</option>
            <option value="11">埼玉県</option>
            <option value="12">千葉県</option>
            <option value="13">東京都</option>
            <option value="14">神奈川県</option>
            <option value="15">新潟県</option>
            <option value="16">富山県</option>
            <option value="17">石川県</option>
            <option value="18">福井県</option>
            <option value="19">山梨県</option>
            <option value="20">長野県</option>
            <option value="21">岐阜県</option>
            <option value="22">静岡県</option>
            <option value="23">愛知県</option>
            <option value="24">三重県</option>
            <option value="25">滋賀県</option>
            <option value="26">京都府</option>
            <option value="27">大阪府</option>
            <option value="28">兵庫県</option>
            <option value="29">奈良県</option>
            <option value="30">和歌山県</option>
            <option value="31">鳥取県</option>
            <option value="32">島根県</option>
            <option value="33">岡山県</option>
            <option value="34">広島県</option>
            <option value="35">山口県</option>
            <option value="36">徳島県</option>
            <option value="37">香川県</option>
            <option value="38">愛媛県</option>
            <option value="39">高知県</option>
            <option value="40">福岡県</option>
            <option value="41">佐賀県</option>
            <option value="42">長崎県</option>
            <option value="43">熊本県</option>
            <option value="44">大分県</option>
            <option value="45">宮崎県</option>
            <option value="46">鹿児島県</option>
            <option value="47">沖縄県</option>
    </select> -->
    <div class="form-city"></div>
    <input type="text" name="address" placeholder="都道府県　市区町村　番地　建物名　部屋番号 etc" value="<?= isset($signupCon->getValues()->address) ? h($signupCon->getValues()->address) : ''; ?>" class="form-control">
    <p class="err"><?= h($signupCon->getErrors('address')) ?></p>
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