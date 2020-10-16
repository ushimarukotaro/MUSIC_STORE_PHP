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

  public function getCategories() {
    $stmt = $this->db->query("SELECT * FROM categories");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }


  // 全商品取得
  public function productAll() {
    $stmt = $this->db->query("SELECT p.id,p.product_name,p.maker,p.price,p.image,p.details,p.created,c.category_name FROM products AS p INNER JOIN categories AS c ON p.category_id = c.id");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function searchProduct($keyword) {
    $stmt = $this->db->prepare("SELECT * FROM products WHERE product_name LIKE :product_name AND delflag = 0;");
    $stmt->execute([':product_name' => '%'.$keyword.'%']);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

}
