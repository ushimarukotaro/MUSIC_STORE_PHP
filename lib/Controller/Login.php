<?php
namespace Shop\Controller;

class Login extends \Shop\Controller {
  public function run() {
    // ログインしていればトップページへ移動
    if ($this->isLoggedIn()) {
      header('Location: '. SITE_URL . '/product_all.php');
      exit();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }
  protected function postProcess() {
    try {
      $this->validate();
    } catch (\Shop\Exception\EmptyPost $e) {
        $this->setErrors('login', $e->getMessage());
    }
    $this->setValues('email', $_POST['email']);
    if ($this->hasError()) {
      return;
    } else {
      try {
        $userModel = new \Shop\Model\User();
        $user = $userModel->login([
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);
      }
      catch (\Shop\Exception\UnmatchEmailOrPassword $e) {
        $this->setErrors('login', $e->getMessage());
        return;
      }
      catch (\Shop\Exception\DeleteUser $e) {
        $this->setErrors('login', $e->getMessage());
        return;
      }
      // ログイン処理
      //session_regenerate_id関数･･･現在のセッションIDを新しいものと置き換える。セッションハイジャック対策
      session_regenerate_id(true);
      // ユーザー情報をセッションに格納
      $_SESSION['me'] = $user;
      // 商品一覧ページへリダイレクト
      header('Location: '. SITE_URL . '/product_all.php');
      exit();
    }
  }
  private function validate() {
    $validate = new \Shop\Controller\Validate();
    // トークンが空またはPOST送信とセッションに格納された値が異なるとエラー
    $validate->tokenCheck($_POST['token']);
    // emailとpasswordのキーがなかった場合、強制終了
    $validate->unauthorizedCheck([$_POST['email'],$_POST['password']]);
    if($validate->emptyCheck([$_POST['email'],$_POST['password']])) {
      throw new \Shop\Exception\EmptyPost("メールアドレスまたはパスワードを入力してください。");
    }
  }
}
