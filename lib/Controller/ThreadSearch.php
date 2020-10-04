<?php
namespace Bbs\Controller;

class ThreadSearch extends \Bbs\Controller {

  public function run() {
    if($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['type'] === 'searchthread') {
      $threadData = $this->searchThread();
      return $threadData;
    }
  }

  public function searchThread(){
    try {
      $this->validate();
    } catch (\Bbs\Exception\EmptyPost $e) {
      $this->setErrors('keyword', $e->getMessage());
    } catch (\Bbs\Exception\CharLength $e) {
      $this->setErrors('keyword', $e->getMessage());
    }

    $keyword = $_GET['keyword'];
    $this->setValues('keyword', $keyword);
    if ($this->hasError()) {
      return;
    } else {
      $threadModel = new \Bbs\Model\Thread();
      $threadData = $threadModel->searchThread($keyword);
      return $threadData;
    }
  }

  private function validate() {
    $validate = new \Bbs\Controller\Validate();
    if($validate->emptyCheck([$_GET['keyword']])) {
      throw new \Bbs\Exception\EmptyPost("キーワードが入力されていません！");
    }
    if($validate->charLenghtCheck($_GET['keyword'],20)) {
      throw new \Bbs\Exception\CharLength("キーワードは20文字以内で入力してください。");
    }
  }
}
