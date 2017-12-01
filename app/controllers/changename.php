<?php
    session_start();
    require("../../classes/db2.php");
    require("../dbconfig.php");
    if(isset($_GET['mail']) && isset($_GET['phone']) && isset($_GET['newname'])){
        $dbo = new db();
        $lname = $_GET['newname'];
        $lphon = $_GET['phone'];
        $lmail = $_GET['mail'];
        $q = "update user set name='{$lname}' where email='{$lmail}' and phone='{$lphon}'";
        $lh = $dbo->executeQuery($q);
        if($lh===0){
            echo "-1";
            }else{
            $_SESSION['user']['name'] = $lname;
            echo "1";
            }
        }
    ?>