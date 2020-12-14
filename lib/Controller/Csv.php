<?php
namespace Shop\Controller;
class Csv extends \Shop\Controller {
  public function outputCsv($users_id,$created){
    try {
      $historyModel = new \Shop\Model\Product();
      $data = $historyModel->getPurchaseCsv($users_id,$created);
      // var_dump($data);
      // exit();
      $csv=array('users_id','user_name','product_name','num','price','purchase_date');
      $csv=mb_convert_encoding($csv,'SJIS-WIN','UTF-8');
      $date = date("YmdH:i:s");
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename='. $date .'_purchase.csv');
      $stream = fopen('php://output', 'w');
      stream_filter_prepend($stream,'convert.iconv.utf-8/cp932');
      $i = 0;
      foreach ($data as $row) {
        if($i === 0) {
          fputcsv($stream , $csv);
        }
        fputcsv($stream , $row);
        $i++;
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }
}