<?php
require_once(__DIR__ .'/header.php');
$app = new Shop\Controller\UserManage();
// var_dump($_POST['product_id']);
$app->run();
