<?php
require_once("../../classes/db2.php");
if(isset($_GET['tk']) && isset($_GET['user'])){
$db = new db();
$pwd = $_GET['tk'];
$uname = $_GET['user'];
$chQ = "select * from user where passwd='{$pwd}' AND username='{$uname}'";
$cQ = $db->getRowAssoc($chQ);
if(sizeof($cQ)>0){
      $doQ = "update user set status='1' where passwd='{$pwd}' AND username='{$uname}'";
      $dQ = $db->executeQuery($doQ);
      echo true;
    }
    else{
      echo false;
    }
}else{
  $fp = fopen("../../classes/Error/ErrorLog.txt","a+");
  $ft = "Illegal Access from {$_SERVER['REMOTE_ADDR']}\n";
  fwrite($fp,$ft);
  fclose($fp);
}
?>
