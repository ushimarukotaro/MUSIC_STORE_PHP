<?php
require_once(__DIR__ . "/header.php");
?>
<div class="title">
  <h1 class="page__ttl">商品新規登録画面</h1>
</div>
<div class="container">
  <p>権限：1=一般ユーザー、99=管理者</p>
  <form action="product_create_confirm.php" method="post" id="" class="form pro_form" enctype="multipart/form-data">
    <div class="col-md-8">
      <div class="form-group">
        <label>商品名
          <input type="text" name="pro_name" value="" class="form-control">
        </label>
        <p class="err"></p>
      </div>
      <div class="form-group">
        <label>メーカー
          <input type="text" name="maker" value="" class="form-control">
        </label>
        <p class="err"></p>
      </div>
      <div class="form-group">
        <label>カテゴリー</label>
        <select name="category">
          <option value="" selected disabled>選択してください</option>
          <option value="guitar">ギター</option>
          <option value="bass">ベース</option>
          <option value="drum">ドラム</option>
          <option value="keyboard">キーボード</option>
          <option value="mic">マイク</option>
          <option value="amp">アンプ</option>
          <option value="effecter">エフェクター</option>
          <option value="accessory">アクセサリー</option>
        </select>
        <p class="err"></p>
      </div>
      <div class="form-group">
        <label>値段
          <input type="text" name="price" value="" class="form-control">
        </label>
        <p class="err"></p>
      </div>
      <div class="form-group">
      <label>商品説明</label>
      <textarea name="details" class="form-control" placeholder="商品説明" rows="14"></textarea>
      <p class="err"></p>
    </div>
      <div class="form-group">
        <div class="imgarea ">
          <label>
          <span class="btn-gray file-btn">
            画像を洗濯してください
            <input type="file" name="image" class="form" style="display:none" accept="image/*">
          </span>
          </label>
          <div class="imgfile">
            <img src="./asset/img/noimage.png" alt="">
          </div>
        </div>
      </div>
    </div>
    <input type="submit" name="create" value="登録" class="btn btn-primary">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <a href="./product_manage.php" onclick="history.back()" class="btn btn-primary">戻る</a>
  </form>
</div>

<?php
require_once(__DIR__ . "/footer.php");
?>