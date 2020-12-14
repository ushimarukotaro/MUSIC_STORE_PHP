<?php
require_once(__DIR__ .'/../config/config.php');
if(isset($_POST['type'])) {
  $users_id = $_POST['users_id'];
  $created = $_POST['created'];
  $csvCon = new Shop\Controller\Csv();
  $csvCon->outputCsv($users_id,$created);
  exit();
} else {
  header('Location: '. SITE_URL . '/purchase_history.php');
  exit();
}
?>