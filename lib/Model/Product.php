<?php
namespace Shop\Model;
class Product extends \Shop\Model {
  public function createProduct($values) {
    try {
      $sql = "INSERT INTO products (product_name,maker,category_id,price,details,image,created,modified) VALUES (:product_name,:maker,:category_id,:price,:details,:image,now(),now())";
      $stmt = $this->db->prepare($sql);

      $res = $stmt->execute([
        'product_name' => $values['product_name'],
        'maker' => $values['maker'],
        'category_id' => $values['category_id'],
        'price' => $values['price'],
        'details' => $values['details'],
        'image' => $values['image'],
      ]);
    } catch (\Exception $e) {
      echo $e->getMessage();
      $this->db->rollBack();
    }
  }

  public function updatePro($values) {
    $stmt = $this->db->prepare("UPDATE products SET product_name = :product_name,maker = :maker,category_id = :category_id,price = :price,details = :details, image = :image, modified = now() WHERE id = :id");
    $res = $stmt->execute([
      ':product_name' => $values['product_name'],
      ':maker' => $values['maker'],
      ':category_id' => $values['category_id'],
      ':price' => $values['price'],
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
    $stmt = $this->db->query("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE delflag = 0");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  // 1件商品取得
  public function productShow($values) {
    $stmt = $this->db->prepare("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,p.delflag,c.id,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE p.id = :id");
    $stmt->execute([
      ':id' => $_GET['id'],
    ]);
    return $stmt->fetch(\PDO::FETCH_OBJ);
  }

    //　カテゴリーごとに取得
  public function productCategory($values) {
    $stmt = $this->db->prepare("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id WHERE c.id = :id AND delflag = 0");
    $stmt->execute([
      ':id' => $_GET['id'],
    ]);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function searchProduct($keyword) {
    $stmt = $this->db->prepare("SELECT * FROM products WHERE product_name LIKE :product_name AND delflag = 0;");
    $stmt->execute([':product_name' => '%'.$keyword.'%']);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

}
