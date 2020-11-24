<?php
require_once(__DIR__ . '/header.php');
$app = new Shop\Controller\PurchaseDone();
$app->run();
$cart = $_SESSION['cart'];
$num = $_SESSION['num'];
?>

<div class="title">
  <h1 class="page__ttl">購入完了</h1>
</div>
<div class="thanks_wrap">
  <div class="thanks_sentence">
    <p>購入手続きが完了しました。</p>
    <p><?= $_SESSION['me']->email ?>宛にメールが送信されます。ご確認ください。</p>
    <p>ご利用ありがとうございました。</p>
    <p>またのご利用お待ちしております。</p>
  </div>
  <div class="thanks_img">
    <img src="./asset/img/ojigi_tenin_woman.png">
  </div>
</div>
<a class="btn btn-primary back-to-top" href="product_all.php">商品一覧に戻る</a>

<?php
require_once(__DIR__ . '/footer.php');
?>