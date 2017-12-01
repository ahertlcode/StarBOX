
<html lang="en">
<head>
<title>Test Page</title>
<link rel="shortcut icon" href="images/starboximg.jpg"/>
</head>
<body>
<div class="col-lg-12">
<table width="100%">
	<tr>
			<td colspan="4"><div id="UInfo"></div>
			</td><td><br/><br/><div id="UPix"><img src="images/starboximg.jpg" height="50px" width="50px" /></div></td>
	</tr>
	<tr>
		<td colspan="3">
			<div id="showQ"><?php echo $Question['question']; ?></div>
		</td>
		<td colspan="2">
			<div id="showImg"><img src="images/starboximg.jpg" height="70px" width="125px" /></div>
		</td>
	</tr>
	<tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" /><?php echo $Question['optionA']; ?></td></tr>
	<tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" /><?php echo $Question['optionB']; ?></td></tr>
	<tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" /><?php echo $Question['optionC']; ?></td></tr>
	<tr><td colspan="5"><input type="radio" name="uAnswer" id="uAnswer" /><?php echo $Question['optionD']; ?></td></tr>
	<tr>
		<td><button>Previous Question</button></td>
		<td><button name="btnNext" id="btnNextid" class="btn btn-warning">Next Question >></button></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><button>End Text</button></td>
	</tr>
</table>
</div>
</body>
</html>

