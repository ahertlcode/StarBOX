<?php
if(isset($_GET['col']) && isset($_GET['val'])){
  require_once("../dbconfig.php");
  require_once("../../classes/db2.php");
  $db = new db();
  $vquery = "select * from user where ".$_GET['col']." = '".$_GET['val']."'";
  $user = $db->getRows($vquery);
  echo sizeof($user);
}
?>
