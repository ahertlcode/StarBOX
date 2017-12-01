
<html lang="en">
<head>
<title>Test Page</title>
<link rel="shortcut icon" href="images/starboximg.jpg"/>
</head>
<body>
<div class="col-lg-12">
<table width="100%">
	<tr>
			<td colspan="4"><div id="UInfo"><?php echo $Question['name']; ?><br/><?php echo $Question['email']; ?><br/><?php echo $Question['phone']; ?></div>
			</td><td><div id="UPix"><img src="images/starboximg.jpg" height="50px" width="50px" /></div></td>
	</tr>
	<tr>
		<td colspan="3">
			<div id="showQ"><?php echo $Question['passwd']; ?></div>
		</td>
		<td colspan="2">
			<div id="showImg"><img src="images/starboximg.jpg" height="70px" width="125px" /><span>Click the image to Enlarge.</span></div>
		</td>
	</tr>
	<tr><td colspan="5"><input type="radio" />option A</td></tr>
	<tr><td colspan="5"><input type="radio" />option B</td></tr>
	<tr><td colspan="5"><input type="radio" />option C</td></tr>
	<tr><td colspan="5"><input type="radio" />option D</td></tr>
	<tr><td colspan="5"><input type="radio" />option E</td></tr>
	<tr>
		<td><button>Previous Question</button></td>
		<td><button>Next Question >></button></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><button>End Text</button></td>
	</tr>
</table>
</div>
</body>
</html>

