<?php
namespace Shop\Controller;
// Controllerクラス継承
class Signup extends \Shop\Controller {
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
    } catch (\Shop\Exception\EmptyPost $e) {
        $this->setErrors('username', $e->getMessage());
    } catch (\Shop\Exception\InvalidEmail $e) {
        $this->setErrors('email', $e->getMessage());
    } catch (\Shop\Exception\EmptyPost $e) {
        $this->setErrors('zip1', $e->getMessage());
    } catch (\Shop\Exception\EmptyPost $e) {
        $this->setErrors('zip2', $e->getMessage());
    } catch (\Shop\Exception\EmptyPost $e) {
        $this->setErrors('prefecture_id', $e->getMessage());
    } catch (\Shop\Exception\EmptyPost $e) {
        $this->setErrors('address2', $e->getMessage());
    } catch (\Shop\Exception\InvalidPassword $e) {
        $this->setErrors('password', $e->getMessage());
    }
    $this->setValues('username', $_POST['username']);
    $this->setValues('email', $_POST['email']);
    $this->setValues('zip1', $_POST['zip1']);
    $this->setValues('zip2', $_POST['zip2']);
    $this->setValues('prefecture_id', $_POST['prefecture_id']);
    $this->setValues('address2', $_POST['address2']);
    if ($this->hasError()) {
      return;
    } else {
      try {
        $userModel = new \Shop\Model\User();
        $user = $userModel->create([
          'username' => $_POST['username'],
          'email' => $_POST['email'],
          'zip1' => $_POST['zip1'],
          'zip2' => $_POST['zip2'],
          'prefecture_id' => $_POST['prefecture_id'],
          'address2' => $_POST['address2'],
          'password' => $_POST['password'],
        ]);
      }
      catch (\Shop\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }

      $userModel = new \Shop\Model\User();
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

  public function getPrefecture() {
    $prefectureModel = new \Shop\Model\User();
    $res = $prefectureModel->getPrefectures();
    return $res;
  }

  // バリデーションメソッド
  private function validate() {
    $validate = new \Shop\Controller\Validate();
    $validate->tokenCheck($_POST['token']);
    $validate->unauthorizedCheck([$_POST['email'],$_POST['username'],$_POST['password']]);
    if ($validate->mailCheck($_POST['email'])) {
      throw new \Shop\Exception\InvalidEmail("メールアドレスの形式が不正です!");
    }
    if($validate->emptyCheck([$_POST['username']])) {
      throw new \Shop\Exception\EmptyPost("ユーザー名が入力されていません");
    }
    if($validate->emptyCheck([$_POST['zip1']])) {
      throw new \Shop\Exception\EmptyPost("郵便番号に未入力があります！");
    }
    if($validate->emptyCheck([$_POST['zip2']])) {
      throw new \Shop\Exception\EmptyPost("郵便番号に未入力があります！");
    }
    if($validate->emptyCheck([$_POST['prefecture_id'],$_POST['address2']])) {
      throw new \Shop\Exception\EmptyPost("住所が入力されていません");
    }
    if($validate->passwordCheck([$_POST['password']])) {
      throw new \Shop\Exception\InvalidPassword("パスワードは半角英数字で入力してください。");
    }
  }
}
