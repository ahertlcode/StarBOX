<?php 
	/** PHPExcel_IOFactory */
    require_once("../../classes/PHPExcel/IOFactory.php");
	
    require_once("../dbconfig.php");
    require_once("../../classes/db2.php");
    ?>
<!DOCTYPE html />
<html lang="en">
<head>
<title>Mass Questions Upload</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../../js/jquery-1.11.3.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<link rel="shortcut icon" href="../../images/starboximg.jpg"/>
<link rel="stylesheet" href="../../css/bootstrap.min.css" />
<link  rel="stylesheet" href="../../css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="../../css/index.css" />
</head>
<body><br/>
<h1>Mass Questions Upload</h1>
<form method="post" enctype="multipart/form-data">
<div class="col-lg-12">
<table class="table">
<tr>
				<td>Exam type</td>
				<td><select name="examtype" id="examtype" class="form-control">
				<option value="-1" selected>...choose exam type...</option>
				<option value="WAEC">WAEC</option>
				<option value="NECO">NECO</option>
				<option value="NABTEB">NABTEB</option>
				<option value="UTME">UTME</option>
				</select></td>
			</tr>
			<tr>
				<td>Subject</td>
				<td><select name="subject" id="subject" class="form-control">
				<option value="-1" selected>...choose subject...</option>
				<option value="Chemistry">Chemistry</option>
				<option value="Physics">Physics</option>
				<option value="English">English</option>
				<option value="Maths">Maths</option>
				<option value="Economics">Economics</option>
				</select></td>
			</tr>
<tr>
	<td><input type="file" name="massUpload1" id="massUpload1" class="form-control" /></td>
	<td><button type="submit" name="massUpload" id="massUpload" class="btn btn-success">Upload</button></td>
</tr>
</table>
</div>
</form>
<?php
if(isset($_POST["massUpload"]))
{
	$f3 = require("../../lib/base.php");
	$f3->set('DEBUG',3);
	$f3->route('GET|POST /massUpload.php',function(){
	global $dbname,$dbuser,$dbpass;
	$db = new DB\SQL("mysql:host=localhost;port=3306;dbname={$dbname}","{$dbuser}","{$dbpass}");
	$user = new DB\SQL\Mapper($db,'questionbank');
	$subj = $_POST['subject'];
	$examtype = $_POST['examtype'];
	if(move_uploaded_file($_FILES['massUpload1']['tmp_name'],"../../tmp/".$_FILES['massUpload1']['name'])){
	}else{ //echo $_FILES['massUpload1']['error']; 
	}
	
//	$inputFileType = 'Excel5';
	$inputFileType = 'Excel2007';
//	$inputFileType = 'Excel2003XML';
//	$inputFileType = 'OOCalc';
//	$inputFileType = 'SYLK';
//	$inputFileType = 'Gnumeric';
//	$inputFileType = 'CSV';
$inputFileName = "../../tmp/".$_FILES['massUpload1']['name'];

//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory with a defined reader type of ',$inputFileType,'<br />';
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($inputFileName);


//echo '<hr />';

$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
//echo sizeof($sheetData);
//var_export($sheetData);exit;
//Parse Excel WorkBook for Data
for($xl = 2;$xl<=sizeof($sheetData);$xl++)
	{
		$query = "insert into questionbank values('0','{$sheetData[$xl]['B']}',";
		$query .= "'{$sheetData[$xl]['C']}','{$sheetData[$xl]['D']}',";
		$query .= "'{$sheetData[$xl]['E']}','{$sheetData[$xl]['F']}',";
		$query .= "'{$sheetData[$xl]['G']}','{$sheetData[$xl]['H']}',";
		$query .= "'{$subj}','{$examtype}',";
		$query .= "'{$sheetData[$xl]['I']}'";
		$query .= ")";
		//$fq = addslashes($query);
		$db->exec($query);
	}
});
$f3->run();
}
?>
</body>
</html>
