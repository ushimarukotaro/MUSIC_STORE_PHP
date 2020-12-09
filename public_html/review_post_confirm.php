<?php
require_once(__DIR__ . '/header.php');
?>
<div class="title">
  <h1 class="page__ttl">レビュー内容確認</h1>
</div>
<form class="form" method="post" action="review_post_done.php">
  <table class="review_table">
    <tbody>
      <tr>
        <th class="first-th">評価</th>
        <?php if (!isset($_POST['hyouka'])) : ?>
          <td>
            <p class="err">評価が選択されていません！</p>
          </td>
        <?php else : ?>
          <td><?= h($_POST['hyouka']) ?></td>
        <?php endif; ?>
      </tr>
      <tr>
        <th class="last-th">レビュー内容</th>
        <td>
          <?php if ($_POST['content'] == '') : ?>
            <p class="err">レビュー内容が未入力です！</p>
          <?php else : ?>
            <?= nl2br(h($_POST['content'])); ?>
          <?php endif; ?>
        </td>
      </tr>
    </tbody>
  </table>
  <?php if (!isset($_POST['hyouka']) || $_POST['content'] == '') : ?>
    <input type="button" onclick="history.back()" class="btn btn-outline-primary" value="戻る">
  <?php else : ?>
    <p class="review_confirm_p">上記の内容で投稿しますか？</p>
    <input type="submit" class="btn btn-primary">
    <input type="hidden" name="userid" value="<?= h($_SESSION['me']->id); ?>">
    <input type="hidden" name="productid" value="<?= h($_POST['productid']); ?>">
    <input type="hidden" name="hyouka" value="<?= h($_POST['hyouka']) ?>">
    <input type="hidden" name="content" value="<?= h($_POST['content']); ?>">
    <input type="hidden" name="review_id" value="<?= h($_POST['content']); ?>">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']) ?>">
    <input type="button" onclick="history.back()" class="btn btn-outline-primary" value="戻る">
  <?php endif; ?>
</form>
<?php
require_once(__DIR__ . '/footer.php');
