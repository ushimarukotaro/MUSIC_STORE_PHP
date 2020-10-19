<?php
require_once(__DIR__ . '/header.php');
$app = new Shop\Controller\ProductUpdate();
$app->run();
?>

<?php
require_once(__DIR__ . '/footer.php');