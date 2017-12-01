var mover = 0;
var sh1 = false;
var solabel = false;
var labels = $(".solabel"); //document.getElementsByClassName("solabel"); //
var lbl = labels.length;
for(t=0;t<lbl;t++){
	$(labels[t]).css("visibility","hidden");
}
function getScreenHeight(){
	return $(window).height();
	}
function getScreenWidth(){
	return $(window).width();
	}
function getHalfScreenHeight(){
	return parseInt(getScreenHeight()/2);
	}
function getQuarterScreenHeight(){
	return parseInt(getScreenHeight()/4);
	}
function getHalfScreenWidth(){
	return parseInt(getScreenWidth()/2);
	}
function getQuarterScreenWidth(){
	return parseInt(getScreenWidth()/4);
	}
function showSlide()
{
	var sld = document.getElementsByClassName("slab");
    var ltop = sld.length;
	if (mover == 0){
		mover+=1;
		setTimeout("showSlide()","0");
		}
	else if(mover>0 && mover<=ltop)
	{
		$(sld[mover-1]).slideToggle();
		mover+=1;
		setTimeout("showSlide()","5000");
		}
	else{
		mover = 0;
		setTimeout("showSlide()","0");
		 }
	}
function showNum(obj){
		var qnum = obj.replace("btn","");
		window.location.href = "../views/?q="+qnum;
	}
function showNext(){
		window.location.href = "../views/?q=next";
	}
function showPrev(){
		window.location.href = "../views/?q=prev";
	}
function setAnswer(ques,ans,cor){
		document.getElementById("dwin").src = "../models/setAnswer.php?q="+ques+"&a="+ans+"&c="+cor;
	}
function EndTest(why){
		if(why=="check"){
		if(confirm("Are you sure? You want to End this Test?")===true){
			window.location.href = "../views/?q=u";
		}
		}
		if(why=="timeup"){
			window.location.href = "../views/?q=t";
		}
	}
function setViews()
	{
			var je = document.getElementById("subject").value;
			var exam = document.getElementById("examtype").value;
			var md = document.getElementById("mode").value;
			/*$.get("../models/setPas.php?subj="+je+"&exam="+exam,function(res){
				alert(res);
			});*/
			$.ajax({
			url: "../models/setPas.php?subj="+je+"&exam="+exam+"&mode="+md,
			type: 'GET',
			success: function(data){ 
				window.location.href = "../views/";
			},
			error: function(data){
				alert('There is an error!'); //or whatever
			}
			});			
	}
function getDateNow(){
var d = new Date();
var myd = d.getFullYear()+"-"+parseInt(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
$("#datereg").val(myd);
}
function passhash(id)
{
	var hsh;
	var pass = $("#"+id).val();
	$.get("../controllers/pass_hash.php?p="+pass,function(hsh){
		$("#passwd").val(hsh);
		});

	}
function showNoConfirm(msg){
	var obj = $("#noconfirm");
	obj.css("zIndex",10);
	var xtop = parseInt(getHalfScreenHeight())+"px";
	var xleft = parseInt(getHalfScreenWidth()-200)+"px";
	obj.html(msg) ;
	obj.width("350px");
	obj.height("auto");
	obj.css("margin-top",xtop);
	obj.css("margin-left",xleft);
	obj.css("text-align","justify");
	obj.css("padding","25");
	obj.css("visibility","visible");
	setTimeout("removeNoConfirm()",10000);
	}
function removeNoConfirm(){
	var dj = $("#noconfirm");
	dj.html(" ");
	dj.width("0px");
	dj.height("0px");
	dj.css("margin-top",0);
	dj.css("margin-left",0);
	dj.css("zIndex","-1");
	dj.css("position","absolute !important");
	dj.css("visibility","hidden");
	}
function confirmtoken(tk,ui){
	$.get("app/controllers/confirmtoken.php?tk="+tk+"&user="+ui,function(confirmtk){
		if(confirmtk == true){
			showInfo("Your Email is now confirmed! You can proceed to Login.");
			setTimeout("window.location.href='../../index.php'",10000);
		}else if(confirmtk == false){
			showInfo("Account not found! Please Register a new account.");
			setTimeout("window.location.href='../../index.php'",10000);
		}else{}
	});
}
function showInfo(status,msg){
	var msgbox = $("#msgbox");
	if(status=="Success"){
		iclass = "alert alert-success";
	}else if(status=="warn"){
		iclass = "alert alert-warning";
	}else if(status=="Info"){
		iclass = "alert alert-info";
	}else{
		iclass = "alert alert-danger";
	}
	msgbox.html(msg);
	msgbox.css("width","400px");
	msgbox.css("height","auto");
	msgbox.css("padding","5px");
    msgbox.css("position","absolute");
    msgbox.css("zIndex",9);
	msgbox.css("text-align","justify");
	msgbox.css("visibility","visible");
	msgbox.attr("class",iclass);
	setTimeout("delInfo()",10000);
}
function delInfo()
{
	var bx = $("#msgbox");
	bx.html(" ");
	bx.height("0px");
	bx.width("0px");
	bx.css("visibility","hidden");
}
function passresetrequest(user,pass){
	$.get("app/controllers/resetrequest.php?u="+user+"&tk="+pass,function(cfm){
		if(cfm == true){
			window.location.href = "app/views/request.php?cf=true";
		}else if(cfm == "expired"){
			showInfo("Your request to reset your password has expired, please make another request. NOTE: Password Reset Request has a life time of 15 minutes after which they are no longer valid.");
			setTimeout("window.location.href='app/views/request.php?cf=expired'",5000);
		}else{
			showInfo("Either you already used this link or it does not originates from StarBox. If you actually requested for a password reset contact the product manager or the technical support team. Thank you.");
			setTimeout("window.location.href='index.php#contact'",5000);
		}
	});
}
function compVal(id1,id2){
	var val1 = $("#"+id1).val();
	var val2 = $("#"+id2).val();
	if(val1 === val2){
		if(sh1 == true){
			$("#"+id2).css("border","1px solid #333");
		}
		alert($("#passwd").val());
	}
	else{
		$("#"+id2).css("border","1px solid #f00");
		$("#"+id2).popover({
			title:"Password Hint!",
			content:"Password and Confirm Password must be equal. i.e They must contain the same character in order and sequence."
		});
		$("#passwd").val('');
		sh1 = true;
	}
}
function updaterequest(mail){
	$.get("app/controllers/updaterequest.php?t="+mail,function(out){
		//do nothing
	});
}
function validate(col,val){
	$.get("../controllers/validate.php?col="+col+"&val="+val,function(vl){
	if(vl > 0){
		//$("#"+col).css("background","#f00");
		if(col=="username"){
			$("#UniQueUser").val("no");
		}else if(col=="phone"){
			$("#UniQuePhon").val("no");
		}else if(col=="email"){
			$("#UniQueEmai").val("no");
		}
		showlabel(col);
		solabel = true;
	}else{
		$("#"+col).css("border","auto");
		if(col=="username"){
			$("#UniQueUser").val("yes");
		}else if(col=="phone"){
			$("#UniQuePhon").val("yes");
		}else if(col=="email"){
			$("#UniQueEmai").val("yes");
		}
		if(solabel == true){
			removelabel(col);
		}
	}
	});
}
function showlabel(win){
	var handle = 	$("#"+win+"div");
	handle.css("visibility","visible");
	handle.css("height","auto");
	handle.css("width","100%");
}
function removelabel(win){
	var handle = 	$("#"+win+"div");
	handle.css("visibility","hidden");
	handle.css("height","0px");
	handle.css("width","0px");
	//$("#"+win).css("background","none");
}
function editname(email,phone){
    var newname = prompt("Your name here!","Surname First.");
    if(newname!=null){
        $.get("../controllers/changename.php?mail="+email+"&phone="+phone+"&newname="+newname,function(out){
            if(out==="-1"){
                showInfo("warn","Name could not be changed now, try again later.");
                }else if(out==="1"){
                showInfo("Success","Name Changed Successfully!");
                setTimeout("window.location.href='../admin/?p=ap'",500);
                }else{}
            });
        }
}
function editcity(email,phone){
    var ncity = prompt("Enter your city here!","Ojuelegba.");
    if(ncity != null){
        $.get("../controllers/changecity.php?mail="+email+"&phone="+phone+"&newcity="+ncity,function(coutx){
            if(coutx==="-1"){
                showInfo("warn","City could not be changed now, try again later.");
                }else if(coutx==="1"){
                showInfo("Success","City was changed Successfully!");
                setTimeout("window.location.href='../admin/?p=ap'",500);
                }else{}
            });
        }
}
function editstate(email,phone){
    var nstate = prompt("Enter your state here!","Lagos.");
    if(nstate != null){
        $.get("../controllers/changestate.php?mail="+email+"&phone="+phone+"&newstate="+nstate,function(outx){
            if(outx==="-1"){
                showInfo("warn","State could not be changed now, try again later.");
                }else if(outx==="1"){
                showInfo("Success","State was changed Successfully!");
                setTimeout("window.location.href='../admin/?p=ap'",500);
                }else{}
            });
        }
}
function editctry(email,phone){
    var nctry = prompt("Enter your country here!","Nigeria.");
    if(nctry != null){
        $.get("../controllers/changecountry.php?mail="+email+"&phone="+phone+"&newctry="+nctry,function(utx){
            if(utx==="-1"){
                showInfo("warn","Country could not be changed now, try again later.");
                }else if(utx==="1"){
                showInfo("Success","Country was changed Successfully!");
                setTimeout("window.location.href='../admin/?p=ap'",500);
                }else{}
            });
        }
}
function preventEdit(target){
    alert("You are not allowed to change "+target+" if you have a legitimate reason why you must change "+target+"? Contact Supports. Thank you.");
}