<?php
namespace Bbs\Model;
class Comment extends \Bbs\Model {

  // コメント取得
  public function getComment($thread_id){
    $stmt = $this->db->prepare("SELECT comment_num,username,content,comments.created FROM comments INNER JOIN users ON user_id = users.id WHERE thread_id =:thread_id AND comments.delflag = 0 ORDER BY comment_num ASC LIMIT 5;");
    $stmt->execute([':thread_id' => $thread_id]);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  // CSV出力
  public function getCommentCsv($thread_id){
    $stmt = $this->db->prepare("SELECT comment_num,username,content,comments.created FROM (threads INNER JOIN comments on threads.id = comments.thread_id) INNER JOIN  users ON comments.user_id = users.id WHERE threads.id =:thread_id AND comments.delflag = 0 ORDER BY comment_num ASC;");
    $stmt->execute([':thread_id' => $thread_id]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  // コメント数取得
  public function getCommentCount($thread_id) {
    $stmt = $this->db->prepare("SELECT COUNT(comment_num) AS record_num FROM comments  WHERE thread_id = :thread_id AND delflag = 0;");
    $stmt->bindValue('thread_id',$thread_id);
    $stmt->execute();
    $res =  $stmt->fetch(\PDO::FETCH_ASSOC);
    return $res['record_num'];
  }

  // コメント全件取得
  public function getCommentAll($thread_id){
    $stmt = $this->db->prepare("SELECT comment_num,username,content,comments.created FROM comments INNER JOIN users ON user_id = users.id WHERE thread_id =:thread_id AND comments.delflag = 0 ORDER BY comment_num ASC;");
    $stmt->execute([':thread_id' => $thread_id]);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  // コメント投稿
  public function createComment($values) {
    try {
      $this->db->beginTransaction();
      $lastNum = 0;
      $sql = "SELECT comment_num FROM comments WHERE thread_id = :thread_id ORDER BY comment_num DESC LIMIT 1";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('thread_id',$values['thread_id']);
      $stmt->execute();
      $res = $stmt->fetch(\PDO::FETCH_OBJ);
      $lastNum = $res->comment_num;
      $lastNum++;
      $sql = "INSERT INTO comments (thread_id,comment_num,user_id,content,created,modified) VALUES (:thread_id,:comment_num,:user_id,:content,now(),now())";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('thread_id',$values['thread_id']);
      $stmt->bindValue('comment_num',$lastNum);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('content',$values['content']);
      $stmt->execute();
      $this->db->commit();
    } catch (\Exception $e) {
      echo $e->getMessage();
      $this->db->rollBack();
    }
  }

}
