<?php
require_once(__DIR__ . '/header.php');
$app = new Shop\Controller\FavoriteDelete();
var_dump($_POST['user_id']);
$app->run();

