<?php
namespace Bbs\Model;
class Favorite extends \Bbs\Model {

  public function changeFavorite($values) {
    try {
      $this->db->beginTransaction();
      // レコード取得
      $stmt = $this->db->prepare("SELECT * FROM favorites WHERE thread_id = :thread_id AND user_id = :user_id");
      $stmt->execute([
        ':thread_id' => $values['thread_id'],
        ':user_id' => $values['user_id']
      ]);
      $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      $rec = $stmt->fetch();

      $fav_flag = 0;
      if (empty($rec)) {
        $stmt = $this->db->prepare("INSERT INTO favorites (thread_id,user_id,created) VALUES (:thread_id,:user_id,now())");
        $stmt->execute([
          ':thread_id' => $values['thread_id'],
          ':user_id' => $values['user_id']
        ]);
        $fav_flag = 1;
      } else {
        $stmt = $this->db->prepare("DELETE FROM favorites WHERE thread_id = :thread_id AND user_id = :user_id");
        $stmt->execute([
          ':thread_id' => $values['thread_id'],
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
