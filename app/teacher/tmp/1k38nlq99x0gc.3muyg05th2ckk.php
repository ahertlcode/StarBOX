<html>
<head>

<title></title>
<script src="../../js/jquery-1.11.3.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<link rel="shortcut icon" href="../../images/starboximg.jpg"/>
<link rel="stylesheet" href="../../css/bootstrap.min.css" />
<link  rel="stylesheet" href="../../css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="../../css/index.css" />
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table class="table">
<tr>
				<td>Exam type</td>
				<td><select name="examtype" id="examtype" class="form-control">
				<option value="-1" selected>...choose exam type...</option>
				<option value="WAEC">WAEC</option>
				<option value="NECO">NECO</option>
				<option value="NABTEB">NABTEB</option>
				<option value="JAMB">JAMB</option>
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
				</select></td>
			</tr>
<tr>
	<td><input type="file" name="massUpload1" id="massUpload1" class="form-control" /></td>
	<td><button name="massUpload" id="massUpload" class="btn btn-success">Upload</button></td>
</tr>
</form>

</body>
</html>
