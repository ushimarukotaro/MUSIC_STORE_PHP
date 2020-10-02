<?php
require_once(__DIR__ . '/header.php');
?>
<div class="title">
  <h1 class="page__ttl">購入完了</h1>
</div>
<p class="user-disp">購入しました。<br>ご利用ありがとうございました。<br>またのご利用お待ちしております。</p>
<div class="container">
  <form class="user-confirm" action="user_update_done.php" method="post">
    <a class="btn btn-primary" href="product_all.php">トップへ</a>
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <input type="hidden" name="type" value="delete">
  </form>
</div>
<!--container -->
<?php
require_once(__DIR__ . '/footer.php');
?>