<?php
namespace Shop\Model;
class Product extends \Shop\Model {
  public function createProduct($values) {
    try {
      $sql = "INSERT INTO products (product_name,maker,category_id,price,details,image,created,modified) VALUES (:product_name,:maker,:category_id,:price,:details,:image,now(),now())";
      $stmt = $this->db->prepare($sql);

      $res = $stmt->execute([
        ':product_name' => $values['product_name'],
        ':maker' => $values['maker'],
        ':category_id' => $values['category_id'],
        ':price' => $values['price'],
        ':details' => $values['details'],
        ':image' => $values['image'],
      ]);
    } catch (\Exception $e) {
      echo $e->getMessage();
      $this->db->rollBack();
    }
  }

  public function updatePro($values) {
    $stmt = $this->db->prepare("UPDATE products SET product_name = :product_name,maker = :maker,category_id = :category_id,price = :price,delflag = :delflag,details = :details, image = :image, modified = now() WHERE id = :id");
    $res = $stmt->execute([
      ':product_name' => $values['product_name'],
      ':maker' => $values['maker'],
      ':category_id' => $values['category_id'],
      ':price' => $values['price'],
      ':delflag' => $values['delflag'],
      ':details' => $values['details'],
      'image' => $values['image'],
      ':id' => $_POST['id'],
    ]);
    if ($res === false) {
      throw new \Shop\Exception\DuplicateEmail();
    }
  }

  public function getCategories() {
    $stmt = $this->db->query("SELECT * FROM categories");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function getCategory($values) {
    $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
    $stmt->execute([
      ':id' => $_GET['id'],
    ]);
    return $stmt->fetch(\PDO::FETCH_OBJ);
  }


  // 全商品取得
  public function productAll() {
    $stmt = $this->db->query("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE delflag = 0 ORDER BY p.id DESC");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  // 1件商品取得とお気に入り情報
  public function productShow($values) {
    $user_id = $_SESSION['me']->id;
    $stmt = $this->db->prepare("SELECT p.id AS p_id,p.product_name,p.maker,p.price,p.image,p.details,p.created,p.delflag,c.id,c.category_name,f.id AS f_id FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id LEFT JOIN favorites AS f ON p.id = f.product_id AND f.user_id = $user_id WHERE p.id = :id");
    $stmt->execute([
      ':id' => $_GET['id'],
    ]);
    return $stmt->fetch(\PDO::FETCH_OBJ);
  }

  public function productShowDisp($values) {
    $stmt = $this->db->prepare("SELECT p.id AS p_id,p.product_name,p.maker,p.price,p.image,p.details,p.created,p.delflag,c.id,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE p.id = :id");
    $stmt->execute([
      ':id' => $_GET['id'],
    ]);
    return $stmt->fetch(\PDO::FETCH_OBJ);
  }

  //　カートに入れた商品
  public function cartProducts($values) {
    $cart = $_SESSION['cart'];
    $stmt = $this->db->prepare("SELECT p.id AS p_id,p.product_name,p.maker,p.price,p.image,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE p.id = :id");
    $stmt->execute([
      ':id' => $values,
    ]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  //　欲しい物リスト　お気に入り取得
  public function favProductShowAll() {
    $user_id = $_SESSION['me']->id;
    $stmt = $this->db->query("SELECT p.id AS p_id,p.product_name,p.maker,p.price,p.image,p.delflag,c.id,c.category_name,f.id AS f_id FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id INNER JOIN favorites AS f ON p.id = f.product_id AND f.user_id = $user_id ORDER BY f.id DESC");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  //お気に入り削除
  public function deleteFav($values) {
    $stmt = $this->db->prepare("DELETE FROM favorites WHERE product_id = :product_id AND user_id = :user_id");
    $stmt->execute([
      ':product_id' => $values['product_id'],
      ':user_id' => $_SESSION['me']->id
    ]);
  }

  //　カテゴリーごとに取得
  public function productCategory($values) {
    $stmt = $this->db->prepare("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE c.id = :id AND delflag = 0 ORDER BY p.id DESC");
    $stmt->execute([
      ':id' => $_GET['id'],
    ]);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function productCategoryOld($values) {
    $stmt = $this->db->prepare("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE c.id = :id AND delflag = 0 ORDER BY p.id");
    $stmt->execute([
      ':id' => $_GET['id'],
    ]);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function productCategoryPriceDesc($values) {
    $stmt = $this->db->prepare("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE c.id = :id AND delflag = 0 ORDER BY p.price DESC");
    $stmt->execute([
      ':id' => $_GET['id'],
    ]);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function productCategoryPriceAsc($values) {
    $stmt = $this->db->prepare("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE c.id = :id AND delflag = 0 ORDER BY p.price");
    $stmt->execute([
      ':id' => $_GET['id'],
    ]);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }


    //　検索
  public function searchProduct($keyword) {
    $stmt = $this->db->prepare("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.delflag,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE CONCAT(p.product_name,p.maker,c.category_name) collate utf8_unicode_ci LIKE :product_name AND delflag = 0");
    $stmt->execute([':product_name' => '%'.$keyword.'%']);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }
  

  //　ソート
  public function oldArrivals() {
    $stmt = $this->db->query("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE delflag = 0");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function sortPriceDesc() {
    $stmt = $this->db->query("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE delflag = 0 ORDER BY p.price DESC");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function sortPriceAsc() {
    $stmt = $this->db->query("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE delflag = 0 ORDER BY p.price ASC");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  //購入完了
  public function purchaseDone($values) {
    try {
    $this->db->beginTransaction();
    $sql = "LOCK TABLES histories WRITE";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $stmt = $this->db->prepare("INSERT INTO histories (product_id,user_id,num,created) VALUES (:product_id,:user_id,:num,now())");
    $res = $stmt->execute([
      ':product_id' => $values['product_id'],
      ':user_id' => $values['user_id'],
      ':num' => $values['num']
    ]);
    $stmt->fetchAll(\PDO::FETCH_OBJ);

    $sql = "UNLOCK TABLES";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $this->db->commit();
    } catch (\Exception $e) {
      echo $e->getMessage();
      $this->db->rollBack();
    }
  }


  //購入履歴数と日付取得
  public function getHistories() {
    $stmt = $this->db->prepare("SELECT COUNT(h.id) AS h_id,h.id AS ID,h.created AS h_created,num FROM histories AS h WHERE h.user_id = :id GROUP BY h.created ORDER BY h.created DESC LIMIT 20");
    $stmt->execute([
      ':id' => $_SESSION['me']->id,
    ]);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  //　購入履歴表示
  public function showPurchaseHistory($values) {
    $stmt = $this->db->prepare("SELECT p.id AS p_id,h.created AS h_created,h.num AS h_num,p.image,p.product_name,p.maker,p.price FROM products AS p INNER JOIN histories AS h ON p.id = h.product_id WHERE h.user_id = :id AND delflag = 0 ORDER BY h.created DESC LIMIT 20");
    $stmt->execute([
      ':id' => $_SESSION['me']->id,
    ]);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  //レビュー投稿
  public function postReview($values) {
    $stmt = $this->db->prepare("INSERT INTO reviews (userid,productid,hyouka,content,created,modified) VALUES (:userid,:productid,:hyouka,:content,now(),now())");
    $stmt->execute([
      ':userid' => $values['userid'],
      ':productid' => $values['productid'],
      ':hyouka' => $values['hyouka'],
      ':content' => $values['content'],
    ]);
  }

  // レビュー取得
  public function getReview($values) {
    $stmt = $this->db->prepare("SELECT r.id AS r_id,productid,hyouka,content,r.created AS r_created,r.userid AS r_userid,u.username AS u_name FROM reviews AS r INNER JOIN users AS u ON r.userid = u.id WHERE r.delflag = 0 AND productid = :productid");
    $stmt->bindValue('productid',$_GET['id']);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  //レビュー削除
  public function deleteReview() {
    $stmt = $this->db->prepare("UPDATE reviews SET delflag = :delflag,modified = now() WHERE id = :id");
    $stmt->execute([
      ':delflag' => 1,
      ':id' => $_GET['review_id'],
    ]);
  }

  // CSV出力
  public function getPurchaseCsv($users_id,$created){
    $stmt = $this->db->prepare("SELECT users.id AS u_id,users.username AS u_name,products.product_name AS p_name,histories.num AS h_num,products.price AS p_price,histories.created AS h_created FROM (histories INNER JOIN products on histories.product_id = products.id) INNER JOIN  users ON histories.user_id = users.id WHERE users.id = :users_id AND histories.created = :h_created");
    $stmt->execute([
      ':users_id' => $users_id,
      ':h_created' => $created
      ]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}
