<?php
namespace Shop\Model;
class User extends \Shop\Model {
  public function create($values) {
    $stmt = $this->db->prepare("INSERT INTO users (username,email,zip1,zip2,prefecture_id,address2,password,created,modified) VALUES (:username,:email,:zip1,:zip2,:prefecture_id,:address2,:password,now(),now())");
    $res = $stmt->execute([
      ':username' => $values['username'],
      ':email' => $values['email'],
      ':zip1' => $values['zip1'],
      ':zip2' => $values['zip2'],
      ':prefecture_id' => $values['prefecture_id'],
      ':address2' => $values['address2'],
      // パスワードのハッシュ化
      ':password' => password_hash($values['password'],PASSWORD_DEFAULT),
    ]);
    // メールアドレスがユニークでなければfalseを返す
    if ($res === false) {
      throw new \Shop\Exception\DuplicateEmail();
    }
  }

  public function login($values) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email;");
    $stmt->execute([
      ':email' => $values['email']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();
    if (empty($user)) {
      throw new \Shop\Exception\UnmatchEmailOrPassword();
    }
    if (!password_verify($values['password'], $user->password)) {
      throw new \Shop\Exception\UnmatchEmailOrPassword();
    }
    if ($user->delflag == 1) {
      throw new \Shop\Exception\DeleteUser();
    }
    return $user;
  }

  public function find($id) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id;");
    $stmt->bindValue('id',$id);
    $stmt->execute();
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();
    return $user;
  }

  public function update($values) {
    $stmt = $this->db->prepare("UPDATE users SET username = :username,email = :email, zip1 = :zip1, zip2 = :zip2, prefecture_id = :prefecture_id, address2 = :address2, modified = now() WHERE id = :id");
    $res = $stmt->execute([
      ':username' => $values['username'],
      ':email' => $values['email'],
      ':zip1' => $values['zip1'],
      ':zip2' => $values['zip2'],
      ':prefecture_id' => $values['prefecture_id'],
      ':address2' => $values['address2'],
      ':id' => $_SESSION['me']->id,
    ]);
    if ($res === false) {
      throw new \Shop\Exception\DuplicateEmail();
    }
  }

  public function delete() {
    $stmt = $this->db->prepare("UPDATE users SET delflag = :delflag,modified = now() WHERE id = :id");
    $stmt->execute([
      ':delflag' => 1,
      ':id' => $_SESSION['me']->id,
    ]);
  }

  public function imgDelete() {
    $stmt = $this->db->prepare("UPDATE users SET image = :image, modified = now() WHERE id = :id");
    $stmt->execute([
      ':image' => NULL,
      ':id' => $_SESSION['me']->id,
    ]);
  }

  public function adminShow() {
    $stmt = $this->db->query("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.delflag,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id ORDER BY p.id DESC");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function adminDispShow($values) {
    $stmt = $this->db->prepare("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,p.delflag,c.id,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE p.id = :id");
    $stmt->execute([
      ':id' => $values['product_id'],
    ]);
    return $stmt->fetch(\PDO::FETCH_OBJ);
  }

  public function adminCreate($values) {
    $stmt = $this->db->prepare("INSERT INTO users (username,email,password,image,authority,delflag,created,modified) VALUES (:username,:email,:password,:image,:authority,:delflag,now(),now())");
    $res = $stmt->execute([
      ':username' => $values['username'],
      ':email' => $values['email'],
      ':password' => password_hash($values['password'],PASSWORD_DEFAULT),
      ':image' => $values['image'],
      ':authority' => $values['authority'],
      ':delflag' => $values['delflag'],
    ]);
    if ($res === false) {
      throw new \Shop\Exception\DuplicateEmail();
    }
  }

  public function adminUpdate($values) {
    $stmt = $this->db->prepare("UPDATE users SET username = :username, email = :email, image = :image,authority = :authority, delflag = :delflag, modified = now() WHERE id = :id");
    $stmt->execute([
      ':id' => $values['id'],
      ':username' => $values['username'],
      ':email' => $values['email'],
      'image' => $values['image'],
      'authority' => $values['authority'],
      'delflag' => $values['delflag'],
    ]);
  }

  public function adminDelete($values) {
    $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
    $stmt->execute([":id" => $values]);
  }

  public function getPrefectures() {
    $stmt = $this->db->query("SELECT * FROM prefectures");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }
}
