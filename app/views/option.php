<?php
//require("../../classes/db2.php");
$dbli = new db();
$eque = "select distinct(examtype) from examsetup where status='1'";
$edata = $dbli->getRowAssoc($eque);
$sque = "select distinct(subject) from examsetup where status='1'";
$sdata = $dbli->getRowAssoc($sque);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title></title>
</head>
<body>
<div>
<form method="post">
<table class="table">
<tr>
<td>Exam Type<br/><select name="examtype" id="examtype" class="form-control">
<option value="-1">...Select Exam Type...</option>
<!--<option value="UTME">UTME</option>
<option value="WASSEC">WASSEC</option>
<option value="NABTEB">NABTEB</option>
<option value="NECO">NECO</option>-->
<?php
for($f=0;$f<sizeof($edata);$f++){
	?><option value="<?php echo $edata[$f]['examtype']; ?>"><?php echo strtoupper($edata[$f]['examtype']); ?></option><?php
}
?>
</select></td>
</tr>
<tr>
<td>Subject<br/><select name="subject" id="subject" class="form-control">
<option value="-1">...Select Subject...</option>
<!--<option value="Maths">maths</option>
<option value="English">english</option>
<option value="Physics">physics</option>
<option value="Chemistry">Chemistry</option>-->
<?php
for($f=0;$f<sizeof($sdata);$f++){
	?><option value="<?php echo $sdata[$f]['subject']; ?>"><?php echo strtoupper($sdata[$f]['subject']); ?></option><?php
}
?>
</select></td>
</tr>
<tr>
<td>Exam Mode<br/>
<select name="mode" id="mode" class="form-control">
<option value="-1">...Select Exam Mode...</option>
<option value="Strict">Strict</option>
<option value="study">Study</option>
</select>
</td>
</tr>
<tr>
<td><button type="button" name="testOption" id="testOption" onclick="setViews();" class="btn btn-success">Continue</button></td>
</tr>
</table>
</form>
</div>
</body>
</html>
