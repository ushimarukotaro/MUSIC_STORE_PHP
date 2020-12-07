<?php
require_once(__DIR__ . '/header.php');
?>
<div class="title">
  <h1 class="page__ttl">問合せ確認</h1>
</div>
<form class="form" method="post" action="info_done.php">
  <table class="review_table">
    <tbody>
      <tr>
        <th class="first-th">お名前</th>
        <td>
          <?php if ($_POST['name'] == '' || mb_strlen($_POST['name']) > 20) : ?>
            <p class="err">お名前を正しく入力してください！</p>
          <?php else : ?>
            <?= h($_POST['name']); ?>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>
          <?php if ($_POST['email'] == '' || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) : ?>
            <p class="err">メールアドレスを正しく入力してください！</p>
          <?php else : ?>
            <?= h($_POST['email']); ?>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>件名</th>
        <td>
          <?php if ($_POST['title'] == '' || mb_strlen($_POST['title']) >20) : ?>
            <p class="err">件名を正しく入力してください！</p>
          <?php else : ?>
            <?= ($_POST['title']); ?>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th class="last-th">問合せ内容</th>
        <td>
          <?php if ($_POST['content'] == '') : ?>
            <p class="err">内容が未入力です！</p>
          <?php else : ?>
            <?= nl2br(h($_POST['content'])); ?>
          <?php endif; ?>
        </td>
      </tr>
    </tbody>
  </table>
  <?php if ($_POST['name'] == '' || $_POST['email'] == '' || $_POST['title'] == '' || $_POST['content'] == '' || mb_strlen($_POST['name']) > 20 || mb_strlen($_POST['title']) > 20 || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) : ?>
    <input type="button" onclick="history.back()" class="btn btn-outline-primary" value="戻る">
  <?php else : ?>
  <p class="review_confirm_p">上記の内容で投稿しますか？</p>
  <input type="submit" class="btn btn-primary review-btn">
  <input type="hidden" name="name" value="<?= h($_POST['name']) ?>">
  <input type="hidden" name="email" value="<?= h($_POST['email']) ?>">
  <input type="hidden" name="title" value="<?= h($_POST['title']) ?>">
  <input type="hidden" name="content" value="<?= h($_POST['content']) ?>">
  <input type="hidden" name="type" value="send_mail">
  <input type="button" onclick="history.back()" value="戻る" class="btn btn-outline-primary review-btn">
  <?php endif; ?>
</form>
<?php
require_once(__DIR__ . '/footer.php');
