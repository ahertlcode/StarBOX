<?php
session_start();
if(isset($_GET['q']) && $_GET['a']){
if(!isset($_SESSION['answered'])){ $_SESSION['answered'] = array(); }
$que = $_GET['q'];
$ans = $_GET['a'];
$cor = $_GET['c'];
$ln = array("Q{$que}" => "{$ans},{$cor}");
if(!array_key_exists("Q{$que}",$_SESSION['answered'])){
  $_SESSION['answered'] = array_merge_recursive($_SESSION['answered'],$ln);
}
else{
  ?><script>if(confirm("Are you sure? You want to change your option?: ")==true){<?php
  $_SESSION['answered']["Q{$que}"] = "{$ans},{$cor}";
  ?>}</script><?php
}
}
?>
