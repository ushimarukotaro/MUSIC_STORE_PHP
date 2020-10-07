<?php
namespace Shop\Controller;

class UserManageCreate extends \Shop\Controller {
  public function run() {
    if($this->isAdminLoggedIn()) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->postProcess();
      }
    } else {
      header('Location: '. SITE_URL . '/thread_all.php');
      exit();
    }
  }

  private function postProcess() {
    try {
      $this->validate();
    } catch (\Bbs\Exception\InvalidEmail $e) {
        $this->setErrors('email', $e->getMessage());
    } catch (\Shop\Exception\InvalidName $e) {
        $this->setErrors('username', $e->getMessage());
    } catch (\Shop\Exception\InvalidPassword $e) {
        $this->setErrors('password', $e->getMessage());
    }
    $this->setValues('email', $_POST['email']);
    $this->setValues('username', $_POST['username']);
    if ($this->hasError()) {
      return;
    } else {
      try {
        $userModel = new \Shop\Model\User();
        $user = $userModel->create([
          'email' => $_POST['email'],
          'username' => $_POST['username'],
          'password' => $_POST['password'],
          'image' => $_POST['image'],
          'authority' => $_POST['authority'],
          'delflag' => $_POST['delflag'],
        ]);
      }
      catch (\Shop\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }

      header('Location: '. SITE_URL . '/user_manage.php');
      exit();
    }
  }

  private function validate() {
    $validate = new \Shop\Controller\Validate();
    $validate->tokenCheck($_POST['token']);
    if ($validate->mailCheck($_POST['email'])) {
      throw new \Shop\Exception\InvalidEmail("メールアドレスの形式が不正です!");
    }
    if($validate->emptyCheck([$_POST['username']])) {
      throw new \Shop\Exception\EmptyPost("ユーザー名が入力されていません");
    }
    if($validate->passwordCheck([$_POST['password']])) {
      throw new \Shop\Exception\InvalidPassword("パスワードは半角英数字で入力してください。");
    }
  }
}
