<!DOCTYPE html />
<html lang="en">
<head>
<title>Result</title>
<script language="javascript">
    function printpage(){
        window.print();
    } 
</script>
<style type="text/css">
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
</head>
<body>
<br/><br/>
<table class="table">
<tr class="no-print"><td colspan="7"><a class="no-print" href="#" onclick="printpage();">[PRINT]</a></td></tr>
<tr><td>NAME:</td><td colspan="5">{{@owner.name}}</td><td>UID:{{@owner.username}}</td></tr>
<tr><td>EMAIL:</td><td colspan="4">{{@owner.email}}</td><td>PHONE:</td><td>{{@owner.phone}}</td></tr>
<tr><td>DESIGNATION:</td><td>{{@owner.designation}}</td><td>USER SINCE:</td><td colspan="2">{{@owner.dateReg}}</td><td>STATE:</td><td>{{@owner.state}}</td></tr>
<tr><td>S/N</td><td>TEST DATE</td><td>SUBJECT</td><td>SCORE</td><td>GRADE</td><td>EXAMINATION</td><td>REMARK</td></tr>
<repeat group="{{@result}}" key="{{@ky}}" value="{{@fr}}">
    <tr><td>{{@fr.sn+1}}</td><td>{{@fr.ldate}}</td><td>{{@fr.subject}}</td><td>{{@fr.score}}</td><td>{{@fr.grade}}</td><td>{{@fr.exam}}</td><td>{{@fr.comment}}</td></tr>
</repeat>
</table>
</body>
</html>
