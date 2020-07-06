<?php
  include_once('staticQueries.class.php');
  header('Content-Encoding: UTF-8');
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="sanat.csv";charset=UTF-8');

  $file = fopen('php://output', 'wb');
  fputs($file, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
  fputcsv($file, array('id', 'sana', 'määritelmä'), ',');

  $userID = staticQueries::checkUserID($_REQUEST['user']);
  $arr = staticQueries::getFavouriteWords($userID['id']);
    
  foreach($arr as $eka) {
    foreach($eka as $toka) {
      fputcsv($file, $toka, ',');
    }
  }

  fclose($file);
  die();