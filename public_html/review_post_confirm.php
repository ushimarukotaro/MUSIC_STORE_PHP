<?php
require_once(__DIR__ . '/header.php');
// $app = new Shop\Controller\PostReview();
// $app->run();
?>
<div class="title">
  <h1 class="page__ttl">レビュー内容確認</h1>
</div>
<form class="form" method="post" action="review_post_done.php">
  <table class="review_table">
    <tbody>
      <tr>
        <th class="first-th">評価</th>
        <td><?= h($_POST['hyouka']) ?></td>
      </tr>
      <tr>
        <th>ユーザー名</th>
        <td><?= h($_POST['name']); ?></td>
      </tr>
      <tr>
        <th class="last-th">レビュー内容</th>
        <td>
          <?= nl2br(h($_POST['content'])); ?>
        </td>
      </tr>
    </tbody>
  </table>
  <p class="review_confirm_p">上記の内容で投稿しますか？</p>
  <input type="submit" class="btn btn-primary">
  <input type="hidden" name="userid" value="<?= h($_SESSION['me']->id); ?>">
  <input type="hidden" name="productid" value="<?= h($_POST['productid']); ?>">
  <input type="hidden" name="hyouka" value="<?= h($_POST['hyouka']) ?>">
  <!-- <input type="hidden" name="name" value=""> -->
  <input type="hidden" name="content" value="<?= h($_POST['content']); ?>">
  <input type="hidden" name="token" value="<?= h($_SESSION['token']) ?>">
  <input type="button" onclick="history.back()" class="btn btn-outline-primary" value="戻る">
</form>
<?php
require_once(__DIR__ . '/footer.php');
