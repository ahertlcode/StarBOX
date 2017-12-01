<?php
require_once("../dbconfig.php");
require_once("../../classes/db2.php");
$db = new db();
$subj = $db->getRows("select subject from subjects");
$exam = $db->getRows("select exam from exams");
?>
<!DOCTYPE html />
<html lang="en">
<head>
<title>Question Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<script src="../../js/jquery-1.11.3.js" language="javascript" type="text/javascript"></script>
<script src="../../js/doUserReg.js" language="javascript" type="text/javascript"></script>
<script src="../../js/bootstrap.min.js" language="javascript" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../../css/bootstrap-theme.min.css" type="text/css" />
<script src="../../js/bootstrap.min.js" language="javascript" type="text/javascript"></script>-->
</head>
<body><br/>
<h1>Question Page</h1>
<form method="post" enctype="multipart/form-data">
<div class="col-lg-12">
		<table class="table">
			<tr>
				<td>Exam type</td>
				<td><select name="examtype" id="examtype" class="form-control">
				<option value="-1" selected>...choose exam type...</option>
				<?php
					if(isset($exa) && sizeof($exa)>0){
						for($p=0;$p<sizeof($exa);$p++){
						?><option value="<?php echo $exa[$p][0]; ?>"><?php echo $exa[$p][0]; ?></option><?php
					}
					}
				?>
				<!--<option value="WAEC">WAEC</option>
				<option value="NECO">NECO</option>
				<option value="NABTEB">NABTEB</option>
				<option value="JAMB">JAMB</option>-->
				</select></td>
			</tr>
			<tr>
				<td>Subject</td>
				<td><select name="subject" id="subject" class="form-control">
				<option value="-1" selected>...choose subject...</option>
				<?php if(isset($subj) && sizeof($subj)>0){
					for($h=0;$h<sizeof($subj);$h++){
						?><option value="<?php echo $subj[$h][0]; ?>"><?php echo $subj[$h][0]; ?></option><?php
					}
				}
				?>
				<!--<option value="Chemistry">Chemistry</option>
				<option value="Physics">Physics</option>
				<option value="English">English</option>
				<option value="Maths">Maths</option>-->
				</select></td>
			</tr>
			<tr>
				<td>Question<br/><textarea id="question" name="question" class="form-control" required></textarea></td>
			</tr>
			<tr>
				<td>
					<tr><td>Option A</td><td><input type="radio" id="answer" name="answer" value="A" required/>&nbsp;is answer</td></tr>
					<tr><td colspan="2"><textarea id="optionA" name="optionA" class="form-control"></textarea></td></tr>
				</td>
			</tr>
			<tr>
				<td>
					<tr><td>Option B</td><td><input type="radio" id="answer" name="answer" value="B" required/>&nbsp;is answer</td></tr>
					<tr><td colspan="2"><textarea id="optionB" name="optionB" class="form-control"></textarea></td></tr>
				</td>
			</tr>
			<tr>
				<td>
					<tr><td>Option C</td><td><input type="radio" id="answer" name="answer" value="C" required/>&nbsp;is answer</td></tr>
					<tr><td colspan="2"><textarea id="optionC" name="optionC" class="form-control"></textarea></td></tr>
				</td>
			</tr>
			<tr>
				<td>
					<tr><td>Option D</td><td><input type="radio" id="answer" name="answer" value="D" required/>&nbsp;is answer</td></tr>
					<tr><td colspan="2"><textarea id="optionD" name="optionD" class="form-control"></textarea></td></tr>
				</td>
			</tr>
			<tr>
				<td>Attach Question Image<br/><input type="file" name="questImg1" id="questImg1" onchange="putImg(this);" class="form-control" /></td>
				<input type="hidden" name="questImg" id="questImg"  />
			</tr>
			<tr>
				<td><br/></td>
				<td><button name="btnQustionSave" id="btnQustionSave" class="btn btn-danger">Save</button></td>
			</tr>
		</table>
	</div>
</form>
<?php
if(isset($_POST['btnQustionSave'])){
	//echo "you click submit";exit;
	$f3 = require("../../lib/base.php");
	$f3->route('GET|POST /QPage.php',function(){
	global $dbname,$dbuser,$dbpass;
	$db = new DB\SQL("mysql:host=localhost;port=3306;dbname={$dbname}","{$dbuser}","{$dbpass}");
	$user = new DB\SQL\Mapper($db,'questionbank');
	$file = $_FILES["questImg1"]["tmp_name"];
	$imgType = array("gif", "jpeg", "jpg", "png");
	$extension = explode(".", $_FILES["questImg1"]["name"])[1];
	 if (in_array($extension,$imgType))
	  {
		if($_FILES["questImg1"]["size"]  < 5000000){
		move_uploaded_file($_FILES["questImg1"]["tmp_name"],"../../qmages/".$_FILES["questImg1"]["name"]);
		$user->copyFrom('POST');
		$user->save();
		echo "Image File Successfully uploaded!";
		}
		else{ echo "File size too large, file size should not be greater than 500Kb";}
	  }
	  else{
		echo "File type not supported, please use an image file";
		}
});
$f3->run();
}
?>
</body>
</html>
