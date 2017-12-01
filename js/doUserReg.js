function doUserReg(){
var regstr = "";
regstr += $("#userid").val()+"~";
regstr += $("#passwd").val()+"~";
regstr += $("#name").val()+"~";
regstr += $("#phnumber").val()+"~";
regstr += $("#country").val()+"~";
regstr += $("#state").val()+"~";
regstr += $("#city").val();
$("#holder").load("reguser.php?reg="+encodeURIComponent(regstr));
alert($("#holder").html());
}