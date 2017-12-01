<!DOCTYPE html />
<html lang="en">
<head>
<title>Result</title>
</head>
<body>
<br/><br/>
<table class="table">
<tr><td>NAME:</td><td colspan="5"><?php echo $owner['name']; ?>,&nbsp;&nbsp;&nbsp;UID:<?php echo $owner['username']; ?></td></tr>
<tr><td>EMAIL:</td><td colspan="3"><?php echo $owner['email']; ?></td><td>PHONE:</td><td><?php echo $owner['phone']; ?></td></tr>
<tr><td>DESIGNATION:</td><td><?php echo $owner['designation']; ?></td><td>USER SINCE:</td><td><?php echo $owner['dateReg']; ?></td><td>STATE:</td><td><?php echo $owner['state']; ?></td></tr>
<tr><td>S/N</td><td>SUBJECT</td><td>SCORE</td><td>GRADE</td><td>EXAMINATION</td><td>REMARK</td></tr>
<?php foreach (($result?:array()) as $ky=>$fr): ?>
    <tr><td><?php echo $fr['sn']+1; ?></td><td><?php echo $fr['subject']; ?></td><td><?php echo $fr['score']; ?></td><td><?php echo $fr['grade']; ?></td><td><?php echo $fr['exam']; ?></td><td><?php echo $fr['comment']; ?></td></tr>
<?php endforeach; ?>
</table>
</body>
</html>
