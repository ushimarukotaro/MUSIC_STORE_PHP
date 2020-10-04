<?php
namespace Bbs\Model;
class Thread extends \Bbs\Model {
  public function createThread($values) {
    try {
      $this->db->beginTransaction();
      $sql = "INSERT INTO threads (user_id,title,created,modified) VALUES (:user_id,:title,now(),now())";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('title',$values['title']);
      $res = $stmt->execute();
      $thread_id = $this->db->lastInsertId();
      $sql = "INSERT INTO comments (thread_id,comment_num,user_id,content,created,modified) VALUES (:thread_id,1,:user_id,:content,now(),now())";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('thread_id',$thread_id);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('content',$values['comment']);
      $res = $stmt->execute();
      $this->db->commit();
    } catch (\Exception $e) {
      echo $e->getMessage();
      $this->db->rollBack();
    }
  }

  // 全スレッド取得
  public function getThreadAll(){
    $user_id = $_SESSION['me']->id;
    $stmt = $this->db->query("SELECT t.id AS t_id,title,t.created,f.id AS f_id FROM threads AS t LEFT JOIN favorites AS f ON t.delflag = 0 AND t.id = f.thread_id  AND f.user_id = $user_id ORDER BY t.id desc");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  // お気に入り中の全スレッド取得
  public function getThreadFavoriteAll(){
    $user_id = $_SESSION['me']->id;
    $stmt = $this->db->query("SELECT t.id AS t_id,title,t.created,f.id AS f_id FROM threads AS t INNER JOIN favorites AS f ON t.delflag = 0 AND t.id = f.thread_id  AND f.user_id = $user_id ORDER BY t.id desc");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  // スレッド1件取得
  public function getThread($thread_id){
    $stmt = $this->db->prepare("SELECT * FROM threads WHERE id = :id AND delflag = 0;");
    $stmt->bindValue(":id",$thread_id);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_OBJ);
  }


  public function searchThread($keyword) {
    $stmt = $this->db->prepare("SELECT * FROM threads WHERE title LIKE :title AND delflag = 0;");
    $stmt->execute([':title' => '%'.$keyword.'%']);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

}
