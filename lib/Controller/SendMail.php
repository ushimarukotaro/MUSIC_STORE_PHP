<?php
namespace Shop\Controller;

class SendMail extends \Shop\Controller {
  public function run() {
    if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === 'send_mail' ) {
      $this->sendMail();
    } else {
      header('Location: ' . SITE_URL . '/product_create.php');
      exit();
    }
  }

  private function sendMail() {
    mb_language("japanese");
    mb_internal_encoding("UTF-8");

    $to = h($_POST['email']);
    $title = h($_POST['title']);
    $content = h($_POST['content']);
    $header = 'From: info@ushimarugakki.com';

    mb_send_mail($to, $title, $content, $header);
  }
}