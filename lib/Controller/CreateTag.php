<?php

namespace Shop\Controller;

class CreateTag extends \Shop\Controller {

  public function run() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === 'create_tag') {
      $this->createTag();
    }
  }

  protected function createTag() {
    try {
      $this->validate();
    } catch (\Shop\Exception\EmptyPost $e) {
      $this->setErrors('tag_name', $e->getMessage());
    } catch (\Shop\Exception\CharLength $e) {
      $this->setErrors('tag_name', $e->getMessage());
    }
    $this->setValues('tag_name', $_POST['tag_name']);
    if ($this->hasError()) {
      return;
    } else {
      $tagName = new \Shop\Model\Product();
      $tagName->createTag([
        'tag_name' => $_POST['tag_name'],
      ]);
    }
    header('Location: ' . SITE_URL . '/product_manage.php');
    exit();
  }

  private function validate() {
    $validate = new \Shop\Controller\Validate();
    $validate->tokenCheck($_POST['token']);
    // $validate->unauthorizedCheck([$_POST['email'], $_POST['username']]);
    if ($_POST['tag_name'] == '') {
      throw new \Shop\Exception\EmptyPost("タグが未入力です");
    }
    if($validate->charLengthCheck($_POST['tag_name'],21)) {
      throw new \Shop\Exception\CharLength("20文字以内で入力してください！");
    }
  }
}
