<?php
require_once(__DIR__ .'/header.php');
$app = new Shop\Model\Product();
$app->deleteReview($_GET['review_id']);
$p_id = $_GET['p_id'];
header('Location: ' . SITE_URL . '/purchase_history.php');
exit();
