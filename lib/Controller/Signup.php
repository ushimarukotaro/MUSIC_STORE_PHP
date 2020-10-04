<?php
namespace Bbs\Controller;
// Controllerクラス継承
class Signup extends \Bbs\Controller {
  public function run() {
    if ($this->isLoggedIn()) {
      header('Location: '. SITE_URL . '/product_all.php');
      exit();
    }
    // POSTメソッドがリクエストされていればpostProcessメソッド実行
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }
  private function postProcess() {
    try {
      $this->validate();
    } catch (\Bbs\Exception\InvalidEmail $e) {
        $this->setErrors('email', $e->getMessage());
    } catch (\Bbs\Exception\EmptyPost $e) {
        $this->setErrors('username', $e->getMessage());
    } catch (\Bbs\Exception\InvalidPassword $e) {
        $this->setErrors('password', $e->getMessage());
    }
    $this->setValues('email', $_POST['email']);
    $this->setValues('username', $_POST['username']);
    if ($this->hasError()) {
      return;
    } else {
      try {
        $userModel = new \Bbs\Model\User();
        $user = $userModel->create([
          'email' => $_POST['email'],
          'username' => $_POST['username'],
          'password' => $_POST['password']
        ]);
      }
      catch (\Bbs\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }

      $userModel = new \Bbs\Model\User();
      $user = $userModel->login([
        'email' => $_POST['email'],
        'password' => $_POST['password']
      ]);
      session_regenerate_id(true);
      $_SESSION['me'] = $user;
      header('Location: '. SITE_URL . '/product_all.php');
      exit();
    }
  }

  // バリデーションメソッド
  private function validate() {
    $validate = new \Bbs\Controller\Validate();
    $validate->tokenCheck($_POST['token']);
    $validate->unauthorizedCheck([$_POST['email'],$_POST['username'],$_POST['password']]);
    if ($validate->mailCheck($_POST['email'])) {
      throw new \Bbs\Exception\InvalidEmail("メールアドレスの形式が不正です!");
    }
    if($validate->emptyCheck([$_POST['username']])) {
      throw new \Bbs\Exception\EmptyPost("ユーザー名が入力されていません");
    }
    if($validate->passwordCheck([$_POST['password']])) {
      throw new \Bbs\Exception\InvalidPassword("パスワードは半角英数字で入力してください。");
    }
  }
}
