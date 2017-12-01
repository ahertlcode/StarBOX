
<html lang="en">
<head>
<title>Test Page</title>
<link rel="shortcut icon" href="../../images/starboximg.jpg"/>
</head>
<body>
<div class="col-lg-12">
<form method="post">
<table width="100%">
	<tr>
			<td colspan="4"><div id="UInfo"></div>
			</td><td><br/><br/><div id="UPix"><img src="../../images/starboximg.jpg" height="50px" width="50px" /></div></td>
	</tr>
  <tr><td colspan="5">&nbsp;</tr>
	<tr>
		<td colspan="3">
			<div id="showQ">Question <?php $h=$Question['sn']; $j=Q; $g=$j.$h; ?><?php echo $sn[$g]; ?><br/><?php echo $Question['question']; ?></div>
		</td>
		<td colspan="2">
			<div id="showImg"><img src="../../qmages/<?php echo $Question['questImg']; ?>" height="70px" width="125px" /></div>
		</td>
	</tr>
	<tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" onclick="setAnswer('<?php echo $Question['sn']; ?>','A','<?php echo $Question['answer']; ?>');" /><?php echo $Question['optionA']; ?></td></tr>
	<tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" onclick="setAnswer('<?php echo $Question['sn']; ?>','B','<?php echo $Question['answer']; ?>');" /><?php echo $Question['optionB']; ?></td></tr>
	<tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" onclick="setAnswer('<?php echo $Question['sn']; ?>','C','<?php echo $Question['answer']; ?>');" /><?php echo $Question['optionC']; ?></td></tr>
	<tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" onclick="setAnswer('<?php echo $Question['sn']; ?>','D','<?php echo $Question['answer']; ?>');" /><?php echo $Question['optionD']; ?></td></tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
		<td><button type="button" name="btnPQuest" id="btnPQuest" class="btn btn-warning" onclick="showPrev();">Previous Question</button></td>
		<td><button type="button" name="btnNext" id="btnNext" onclick="showNext();" class="btn btn-success">Next Question >></button></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><button type="button" name="btnEnd" id="btnEnd" onclick="EndTest('check');" class="btn btn-danger">End Text</button></td>
	</tr>
  <tr><td colspan="5">&nbsp;</td></tr>
  <tr><td colspan="5">
    <div class="row">
			<?php foreach (($atempt?:array()) as $ky=>$fr): ?>
					<button type="button" id="btn<?php echo $fr; ?>" onclick="showNum(this.id);" name="btn<?php echo $fr; ?>" class="btn btn-primary"><?php echo $ky+1; ?>,<?php echo $fr; ?></button>
			<?php endforeach; ?><br/>
    </div>
  </td></tr>
</table>
</form>
</div>
</body>
</html>

