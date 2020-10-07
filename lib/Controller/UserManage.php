<?php

namespace Shop\Controller;

class UserManage extends \Shop\Controller {
  public function run() {
    if($this->isAdminLoggedIn()) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->postProcess();
      }
    } else {
      header('Location: '. SITE_URL . '/product_all.php');
      exit();
    }
  }

  public function adminShow() {
    $userModel = new \Shop\Model\User();
    $users = $userModel->adminShow();
    return $users;
  }

  private function postProcess() {
    if(isset($_POST['update']) || isset($_POST['delete'])) {
      try {
        $this->validate();
      } catch (\Shop\Exception\EmptyPost $e) {
          $this->setErrors('id', $e->getMessage());
      }
      $this->setValues('id', $_POST['id']);
      if ($this->hasError()) {
        return;
      } else {
        $userModel = new \Shop\Model\User();
      }
    }

    if(isset($_POST['update'])) {
      $user_id = $_POST['id'];
      $username = $_POST['username' . $_POST['id']];
      $email = $_POST['email' . $_POST['id']];
      $image = $_POST['image' . $_POST['id']];
      $authority = $_POST['authority' . $_POST['id']];
      $delflag = $_POST['delflag' . $_POST['id']];

      if(empty($image)) {
        $image = NULL;
      }

      $userModel->adminUpdate([
        'id' => $user_id,
        'username' => $username,
        'email' => $email,
        'image' => $image,
        'authority' => $authority,
        'delflag' => $delflag
      ]);
      header('Location: '. SITE_URL . '/user_manage.php');
      exit();
    } elseif(isset($_POST['delete'])) {
      $userModel->adminDelete($_POST['id']);
      header('Location: '. SITE_URL . '/user_manage.php');
      exit();
    } elseif(isset($_POST['create'])) {
      header('Location: '. SITE_URL . '/user_manage_create.php');
      exit();
    }
  }

  private function validate() {
    $validate = new \Shop\Controller\Validate();
    $validate->tokenCheck($_POST['token']);
    if (is_null($_POST['id'])) {
      throw new \Shop\Exception\EmptyPost("ユーザーを選択してください");
    }

  }
}
