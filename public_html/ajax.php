<?php
require_once(__DIR__ .'/../config/config.php');

$FavoriteApp = new \Bbs\Model\Favorite();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $res = $FavoriteApp->changeFavorite([
      'thread_id' => $_POST['thread_id'],
      'user_id' => $_POST['user_id']
    ]);
    header('Content-Type: application/json');
    echo json_encode($res);
  } catch (Exception $e) {
    header($_SERVER['SERVER_PROTOCOL']. '500 Internal Server Error', true, 500);
    echo $e->getMessage();
  }
}
