<?php
session_start();
if(!isset($_SESSION['user'])){
	header("Location: ../../index.php?error", true);
	exit;
}else{
?>
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
			</td><td><br/><br/><div id="UPix"><img src="../../images/logo.png" height="50px" width="50px" /></div></td>
	</tr>
  <tr><td colspan="5">&nbsp;</tr>
	<tr>
		<td colspan="3">
			<div id="showQ">Question <set h="{{@Question.sn}}" j="{{Q}}" g="{{@j.@h}}" />{{@sn[@g]}}<br/>{{ @Question.question }}</div>
		</td>
		<td colspan="2">
			<div id="showImg"><img src="../../qmages/{{@Question.questImg}}" height="70px" width="125px" /></div>
		</td>
	</tr>
	<tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" onclick="setAnswer('{{@Question.sn}}','A','{{@Question.answer}}');" />&nbsp;A,&nbsp;{{@Question.optionA}}</td></tr>
	<tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" onclick="setAnswer('{{@Question.sn}}','B','{{@Question.answer}}');" />&nbsp;B,&nbsp;{{@Question.optionB}}</td></tr>
	<tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" onclick="setAnswer('{{@Question.sn}}','C','{{@Question.answer}}');" />&nbsp;C,&nbsp;{{@Question.optionC}}</td></tr>
	<tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" onclick="setAnswer('{{@Question.sn}}','D','{{@Question.answer}}');" />&nbsp;D,&nbsp;{{@Question.optionD}}</td></tr>
    <tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" onclick="setAnswer('{{@Question.sn}}','E','{{@Question.answer}}');" />&nbsp;E,&nbsp;{{@Question.optionE}}</td></tr>
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
			<repeat group="{{@atempt}}" key="{{@ky}}" value="{{@fr}}">
					<button style="margin-top:15px;" type="button" id="btn{{@fr}}" onclick="showNum(this.id);" name="btn{{@fr}}" class="btn btn-primary"><check if="{{@ky < 9}}"><true>0{{ @ky+1 }}</true><false>{{ @ky+1 }}</false></check></button>
			</repeat><br/>
    </div>
  </td></tr>
<tr><td colspan="5">&nbsp;</td></tr>
</table>
</form>
</div>
</body>
</html>
<?php
}
?>
