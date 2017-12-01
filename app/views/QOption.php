<?php
require_once("../dbconfig.php");
require_once("../../classes/db2.php");
$db = new db();
$subj = $db->getRows("select subject from subjects");
$exam = $db->getRows("select exam from exams");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Question List</title>
</head>
<body>
  <form method="post">
    <table class="table">
        <tr>
          <td>Select Subject<br/>
              <select id="sltSubj" name="sltSubj" class="form-control" >
                  <option value="-1">...Select Subject...</option>
                  <?php
                    if(isset($subj) && sizeof($subj)>0){
                      for($f=0;$f<sizeof($subj);$f++){
                      ?><option value="<?php echo $subj[$f][0] ?>"><?php echo $subj[$f][0] ?></option><?php
                    }
                    }
                   ?>
              </select>
          </td>
        </tr>
        <tr>
          <td>Select Exam Type<br/>
              <select id="sltExam" name="sltExam" class="form-control" >
                  <option value="-1">...Select Exam Type...</option>
                  <?php
                    if(isset($exam) && sizeof($exam)>0){
                      for($ft=0;$ft<sizeof($subj);$ft++){
                      ?><option value="<?php echo $exam[$ft][0] ?>"><?php echo $exam[$ft][0] ?></option><?php
                    }
                    }
                   ?>
              </select>
          </td>
        </tr>
        <tr><td align="right"><button type="submit" id="btnQlist" name="btnQlist"> Continue </button></td></tr>
    </table>
  </form>
</body>
</html>
