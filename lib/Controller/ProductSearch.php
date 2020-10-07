<?php
namespace Shop\Controller;

class ProductSearch extends \Shop\Controller {

  public function run() {
    if($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['type'] === 'searchthread') {
      $threadData = $this->searchThread();
      return $threadData;
    }
  }

  public function searchThread(){
    try {
      $this->validate();
    } catch (\Shop\Exception\EmptyPost $e) {
      $this->setErrors('keyword', $e->getMessage());
    } catch (\Shop\Exception\CharLength $e) {
      $this->setErrors('keyword', $e->getMessage());
    }

    $keyword = $_GET['keyword'];
    $this->setValues('keyword', $keyword);
    if ($this->hasError()) {
      return;
    } else {
      $threadModel = new \Shop\Model\Thread();
      $threadData = $threadModel->searchThread($keyword);
      return $threadData;
    }
  }

  private function validate() {
    $validate = new \Bbs\Controller\Validate();
    if($validate->emptyCheck([$_GET['keyword']])) {
      throw new \Shop\Exception\EmptyPost("キーワードが入力されていません！");
    }
    if($validate->charLenghtCheck($_GET['keyword'],20)) {
      throw new \Shop\Exception\CharLength("キーワードは20文字以内で入力してください。");
    }
  }
}
