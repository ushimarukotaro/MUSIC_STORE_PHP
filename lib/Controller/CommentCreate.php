<?php
namespace Shop\Controller;
class CommentCreate extends \Shop\Controller {
  public function run() {
    if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type']  === 'createcomment') {
      $this->createComment();
    }
  }

  private function createComment() {
  try {
      $this->validate();
    } catch (\Shop\Exception\EmptyPost $e) {
        $this->setErrors('content', $e->getMessage());
    } catch (\Shop\Exception\CharLength $e) {
        $this->setErrors('content', $e->getMessage());
    }
    $this->setValues('content', $_POST['content']);
    if ($this->hasError()) {
      return;
    } else {
      $commentModel = new \Bbs\Model\comment();
      $commentModel->createComment([
        'thread_id' => $_POST['thread_id'],
        'user_id' => $_SESSION['me']->id,
        'content' => $_POST['content']
      ]);
    }
    header('Location: '. SITE_URL . '/thread_disp.php?thread_id=' . $_POST['thread_id']);
    exit();
  }

  private function validate() {
    $validate = new \Shop\Controller\Validate();
    $validate->tokenCheck($_POST['token']);
    $validate->unauthorizedCheck([$_POST['content']]);
    if($validate->emptyCheck([$_POST['content']])) {
      throw new \Shop\Exception\EmptyPost("コメントが入力されていません！");
    }
    if($validate->charLenghtCheck($_POST['content'],200)) {
      throw new \Shop\Exception\CharLength("コメントは200文字以内で入力してください。");
    }
  }
}
