<?php
session_start();
require_once("../../classes/db2.php");
if(isset($_GET['u']) && $_GET['tk']){
  $db = new db();
  $uid = $_GET['u'];
  $tok = $_GET['tk'];
  $soQ = "select * from request where user='{$uid}' AND token='{$tok}' AND used='0'";
  $so = $db->getRowAssoc($soQ);
  if(sizeof($so)>0){
  $pr = date("Y-m-d H:s:i");
  $df = date_diff(date_create($pr),date_create($so[0]['restime']));
  $life = (int)$df->format("%i");
  if($life<=15){
    $gUser = $db->getRowAssoc("select email,phone from user where username='{$uid}' AND passwd='{$tok}'");
    $_SESSION['reset'] = $gUser;
    echo true;
  }else if($life>15){
    echo "expired";
  }else{
    echo $life;
  }
}else{
  echo "no value";
}
}else{
  $fp = fopen("../../classes/Error/ErrorLog.txt","a+");
  $ft = "Illegal Access from {$_SERVER['REMOTE_ADDR']}\n";
  fwrite($fp,$ft);
  fclose($fp);
}
?>
