<?php
namespace Shop\Controller;
class UserUpdate extends \Shop\Controller {
  public function run() {
    $this->showUser();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === 'userupdate') {
      $this->updateUser();
    } 
  }

  protected function showUser() {
    $user = new \Shop\Model\User();
    $userData = $user->find($_SESSION['me']->id);
    $this->setValues('username', $userData->username);
    $this->setValues('email', $userData->email);
    $this->setValues('zip1', $userData->zip1);
    $this->setValues('zip2', $userData->zip2);
    $this->setValues('prefecture_id', $userData->prefecture_id);
    $this->setValues('address2', $userData->address2);
  }

  protected function updateUser() {
    try {
      $this->validate();
    } catch (\Shop\Exception\InvalidEmail $e) {
      $this->setErrors('email', $e->getMessage());
    } catch (\Shop\Exception\EmptyPost $e) {
      $this->setErrors('username', $e->getMessage());
    } catch (\Shop\Exception\EmptyPost $e) {
      $this->setErrors('zip1', $e->getMessage());
    } catch (\Shop\Exception\EmptyPost $e) {
      $this->setErrors('zip2', $e->getMessage());
    } catch (\Shop\Exception\EmptyPost $e) {
      $this->setErrors('prefecture_if', $e->getMessage());
    } catch (\Shop\Exception\EmptyPost $e) {
      $this->setErrors('address2', $e->getMessage());
    }
    $this->setValues('username', $_POST['username']);
    $this->setValues('email', $_POST['email']);
    $this->setValues('zip1', $_POST['zip1']);
    $this->setValues('zip2', $_POST['zip2']);
    $this->setValues('prefecture_id', $_POST['prefecture_id']);
    $this->setValues('address2', $_POST['address2']);
    if ($this->hasError()) {
      return;
    } 
    try {
        $userModel = new \Shop\Model\User();
          $userModel->update([
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'zip1' => $_POST['zip1'],
            'zip2' => $_POST['zip2'],
            'prefecture_id' => $_POST['prefecture_id'],
            'address2' => $_POST['address2'],
          ]);
      } catch (\Shop\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }
    
    $_SESSION['me']->username = $_POST['username'];
    header('Location: '. SITE_URL . '/mypage.php');
    exit();
  }


  private function validate() {
    $validate = new \Shop\Controller\Validate();
    $validate->tokenCheck($_POST['token']);
    $validate->unauthorizedCheck([$_POST['email'],$_POST['username']]);
    if ($validate->mailCheck($_POST['email'])) {
      throw new \Shop\Exception\InvalidEmail("メールアドレスの形式が不正です!");
    }
    if($validate->emptyCheck([$_POST['username']])) {
      throw new \Shop\Exception\EmptyPost("ユーザー名が入力されていません");
    }
    if($validate->emptyCheck([$_POST['zip1']])) {
      throw new \Shop\Exception\EmptyPost("郵便番号が入力されていません");
    }
    if($validate->emptyCheck([$_POST['zip2']])) {
      throw new \Shop\Exception\EmptyPost("郵便番号が入力されていません");
    }
    if($validate->emptyCheck([$_POST['prefecture_id']])) {
      throw new \Shop\Exception\EmptyPost("都道府県が選択されていません");
    }
    if($validate->emptyCheck([$_POST['address2']])) {
      throw new \Shop\Exception\EmptyPost("住所が入力されていません");
    }
  }
}

