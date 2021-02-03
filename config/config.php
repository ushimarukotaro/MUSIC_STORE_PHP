<?php
  ini_set('display_errors',1);
  date_default_timezone_set('Asia/Tokyo');

  require_once(__DIR__ . '/define.php');
  require_once(__DIR__ .'/../lib/Controller/functions.php');
  require_once(__DIR__ . '/autoload.php');
  session_start();
  urlFilter();


