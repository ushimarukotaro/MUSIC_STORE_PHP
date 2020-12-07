<?php
require_once(__DIR__ . '/header.php');
$app = new Shop\Controller\SendMail();
$app->run();
?>
<div class="title info-done">
  <h2>メールを送信しました</h2>
</div>
<div class="message">
  <p><?= h($_POST['name']) ?>様問い合わせありがとうございます。</p>
  <p><?= h($_POST['email']) ?>宛に担当者より返信させていただきますのでご確認ください。</p>
  <a href="./product_all.php" class="btn-default">商品一覧ページへ</a>
</div>
<?php
require_once(__DIR__ . '/footer.php');
