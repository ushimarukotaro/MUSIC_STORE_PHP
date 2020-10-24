<?php
namespace Shop\Model;
class Favorite extends \Shop\Model {

  public function changeFavorite($values) {
    try {
      $this->db->beginTransaction();
      // レコード取得
      $stmt = $this->db->prepare("SELECT * FROM favorites WHERE product_id = :product_id AND user_id = :user_id");
      $stmt->execute([
        ':product_id' => $values['product_id'],
        ':user_id' => $values['user_id']
      ]);
      $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      $rec = $stmt->fetch();

      $fav_flag = 0;
      if (empty($rec)) {
        $stmt = $this->db->prepare("INSERT INTO favorites (product_id,user_id,created) VALUES (:product_id,:user_id,now())");
        $stmt->execute([
          ':product_id' => $values['product_id'],
          ':user_id' => $values['user_id']
        ]);
        $fav_flag = 1;
      } else {
        $stmt = $this->db->prepare("DELETE FROM favorites WHERE product_id = :product_id AND user_id = :user_id");
        $stmt->execute([
          ':product_id' => $values['product_id'],
          ':user_id' => $values['user_id']
        ]);
        $fav_flag = 0;
      }
      $this->db->commit();
      return $fav_flag;
    } catch (\Exception $e) {
      echo $e->getMessage();
      // エラーがあったら元に戻す
      $this->db->rollBack();
    }
  }
}
