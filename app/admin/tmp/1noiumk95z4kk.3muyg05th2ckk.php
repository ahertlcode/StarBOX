
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

</body>
</html>
