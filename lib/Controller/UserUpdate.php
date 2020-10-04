<?php
namespace Bbs\Controller;
class UserUpdate extends \Bbs\Controller {
  public function run() {
    $this->showUser();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === 'userupdate') {
      $this->updateUser();
    } elseif($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === 'imgdelete') {
      $this->imgDelete();
    }
  }

  protected function showUser() {
    $user = new \Bbs\Model\User();
    $userData = $user->find($_SESSION['me']->id);
    $this->setValues('username', $userData->username);
    $this->setValues('email', $userData->email);
    $this->setValues('image', $userData->image);
  }

  protected function updateUser() {
    try {
      $this->validate();
    } catch (\Bbs\Exception\InvalidEmail $e) {
      $this->setErrors('email', $e->getMessage());
    } catch (\Bbs\Exception\EmptyPost $e) {
      $this->setErrors('username', $e->getMessage());
    }
    $this->setValues('username', $_POST['username']);
    $this->setValues('email', $_POST['email']);
    if ($this->hasError()) {
      return;
    } else {
      $user_img = $_FILES['image'];
      $old_img = $_POST['old_image'];
      $ext = substr($user_img['name'], strrpos($user_img['name'], '.') + 1);
      $user_img['name'] = uniqid("img_") .'.'. $ext;
      if($old_img == '') {
        $old_img = NULL;
      }
      try {
        $userModel = new \Bbs\Model\User();
        if($user_img['size'] > 0) {
          unlink('./gazou/' .$old_img);
          move_uploaded_file($user_img['tmp_name'],'./gazou/'.$user_img['name']);
          $userModel->update([
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'userimg' => $user_img['name']
          ]);
          $_SESSION['me']->image = $user_img['name'];
        } else {
          $userModel->update([
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'userimg' => $old_img
          ]);
          $_SESSION['me']->image = $old_img;
        }
      }
      catch (\Bbs\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }
    }
    $_SESSION['me']->username = $_POST['username'];
    header('Location: '. SITE_URL . '/mypage.php');
    exit();
  }

  protected function imgDelete() {
    $old_img = $_POST['old_image'];
    if($old_img !== '') {
      $userModel = new \Bbs\Model\User();
      $userModel->imgDelete();
      unlink('./gazou/'.$old_img);
      $_SESSION['me']->image = NULL;
      header('Location: '. SITE_URL . '/mypage.php');
      exit();
    }
  }

  private function validate() {
    $validate = new \Bbs\Controller\Validate();
    $validate->tokenCheck($_POST['token']);
    $validate->unauthorizedCheck([$_POST['email'],$_POST['username']]);
    if ($validate->mailCheck($_POST['email'])) {
      throw new \Bbs\Exception\InvalidEmail("メールアドレスの形式が不正です!");
    }
    if($validate->emptyCheck([$_POST['username']])) {
      throw new \Bbs\Exception\EmptyPost("ユーザー名が入力されていません");
    }
  }
}
