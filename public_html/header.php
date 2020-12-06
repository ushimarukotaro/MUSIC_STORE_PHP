<?php
require_once(__DIR__ . '/../config/config.php');
$r = rand(0,2);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <title>ウシマル楽器</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link href="https://fonts.googleapis.com/css?family=Charm|M+PLUS+Rounded+1c&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/8bc1904d08.js"></script>
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/css/theme.default.min.css">
<link rel="stylesheet" href="./css/styles.css">

</head>

<body>
  <header class="sticky-top header">
    <div class="header__inner">
      <nav>
        <ul>
          <?php if (isset($_SESSION['me'])) : ?>
            <li><a href="<?= SITE_URL; ?>/product_all.php">商品一覧</a></li>
            <?php if (isset($_SESSION['me']->authority) === '99') : ?>
              <li class="dd_last_li"><a href="<?= SITE_URL; ?>/user_manage.php">管理者ページ</a></li>
            <?php endif; ?>
          <?php else : ?>
            <li><a href="<?= SITE_URL; ?>/product_all.php">商品一覧</a></li>
            <li><a href="<?= SITE_URL; ?>/signup.php">ユーザー登録</a></li>
          <?php endif; ?>
        </ul>
      </nav>
      <div class="header-r">
        <?php
        if (isset($_SESSION['me'])) { ?>
          <div class="prof-show" data-me="<?= h($_SESSION['me']->id); ?>">
            <ul>
              <li><a href="<?= SITE_URL; ?>/mypage.php">
                  <span class="name init-bottom"><?= h($_SESSION['me']->username); ?></span></a>
                <ul class="prof-dropdown">
                  <li><a href="<?= SITE_URL; ?>/product_favorite.php" class="name">欲しい物リスト</a></li>
                  <li class="cart-icon"><a href="<?= SITE_URL; ?>/cart_list.php" class="name cart__num" data-cart="<?= count($_SESSION['cart']); ?>">カート<i class="fas fa-shopping-cart"></i></a><span class="count-cart <?= !isset($_SESSION['cart']) ? 'not_display' : ''; ?>"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : ''; ?></span></li>
                  <li><a href="<?= SITE_URL ?>/purchase_history.php" class="name">購入履歴</a></li>
                  <form action="logout.php" method="post" id="logout">
                    <li><label>
                        <span class="name">ログアウト</span>
                        <input type="submit" value="" style="display: none;">
                      </label>
                    </li>
                    <?php if ($_SESSION['me']->authority === '99') : ?>
                      <li><a href="<?= SITE_URL; ?>/product_manage.php" class="name">管理者ページ</a></li>
                    <?php endif; ?>
                    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
                  </form>
                </ul>
              </li>
            </ul>
          </div>
        <?php  } else { ?>
          <div class="prof-show">
            <ul class="name">
              <li class="welcome_guest">ようこそゲスト様</li>
              <li class="">
                <a href="<?= SITE_URL; ?>/login.php" class="name">ログイン</a>
              </li>
            </ul>
          </div>
        <?php } ?>
      </div>
    </div>
  </header>
  <div class="body_wrap">
    <form id="product-category">
      <nav class="nav-left">
        <h3>ジャンル別</h3>
        <ul class="left_ul">
          <li><a href="<?= SITE_URL; ?>/product_category.php?id=1" class="item" onclick="document.getElementById('product_category').submit">ギター</a></li>
          <li><a href="<?= SITE_URL; ?>/product_category.php?id=2" class="item" onclick="document.getElementById('product_category').submit">ベース</a></li>
          <li><a href="<?= SITE_URL; ?>/product_category.php?id=3" class="item" onclick="document.getElementById('product_category').submit">ドラム</a></li>
          <li><a href="<?= SITE_URL; ?>/product_category.php?id=4" class="item" onclick="document.getElementById('product_category').submit">キーボード</a></li>
          <li><a href="<?= SITE_URL; ?>/product_category.php?id=5" class="item" onclick="document.getElementById('product_category').submit">マイク</a></li>
          <li><a href="<?= SITE_URL; ?>/product_category.php?id=6" class="item" onclick="document.getElementById('product_category').submit">アンプ</a></li>
          <li><a href="<?= SITE_URL; ?>/product_category.php?id=7" class="item" onclick="document.getElementById('product_category').submit">エフェクター</a></li>
          <li><a href="<?= SITE_URL; ?>/product_category.php?id=8" class="item" onclick="document.getElementById('product_category').submit">アクセサリー</a></li>
          <div class="imgarea nav_img">
            <a href="<?= SITE_URL; ?>/index.php">
              <?php if ($r == 0) : ?>
                <img src="./asset/img/animal_music_band.png" alt="">
              <?php elseif ($r == 1) : ?>
                <img src="./asset/img/楽器屋.png" alt="">
              <?php else : ?>
                <img src="./asset/img/music_band_studio.png" alt="">
              <?php endif; ?>
            </a>
          </div>
        </ul>
      </nav>
    </form>
    <div class="wrapper">