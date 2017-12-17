<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="keywords" content="reset password,php" />
<title>Reset Password</title>
<link rel="stylesheet" type="text/css" href="../css/main.css" />
<link rel="icon" href="http://joeyrabbitt.com/favicon.ico" type="image/x-icon">
<style type="text/css">
.demo{width:400px; margin:40px auto 0 auto; min-height:250px;}
.demo h3{line-height:24px; text-align:center; color:#360; font-size:16px}
.demo p{line-height:30px; padding:4px}
.demo p span{margin-left:6px; color:#f30}
.input{width:240px; height:24px; padding:2px; line-height:24px; border:1px solid #999}
.btn{position: relative;overflow: hidden;display:inline-block;*display:inline;padding:4px 20px 4px;font-size:16px;line-height:20px;*line-height:22px;color:#fff;text-align:center;vertical-align:middle;cursor:pointer;background-color:#5bb75b;border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;}
</style>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(function(){
	$("#sub_btn").click(function(){
		var email = $("#email").val();
		var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; //匹配Email
		if(email=='' || !preg.test(email)){
			$("#chkmsg").html("Please write a correct email address！");
		}else{
			$("#sub_btn").attr("disabled","disabled").val('submitting').css("cursor","default");
			$.post("sendmail.php",{mail:email},function(msg){
				if(msg=="noreg"){
					$("#chkmsg").html("This email address is invaild！");
					$("#sub_btn").removeAttr("disabled").val('submit').css("cursor","pointer");
				}else{
					$(".demo").html("<h3>"+msg+"</h3>");
				}
			});
		}
	});
})
</script>
</head>

<body>

<div id="main">
   <div class="demo">
        	<p><strong>Input your email and reset the password</strong></p>
        	<p><input type="text" class="input" name="email" id="email"><span id="chkmsg"></span></p>
            <p><input type="button" class="btn" id="sub_btn" value="submit"></p>
	</div>
 <br/><div class="ad_76090"><script src="/js/ad_js/bd_76090.js" type="text/javascript"></script></div><br/>
</div>

<p id="stat"><script type="text/javascript" src="/js/tongji.js"></script></p>
</body>
</html>