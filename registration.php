<?php
#Form submit sees to have some problem
#javascript works but if detects invalid input 
#it still submited
#TO DO
#rerote whole form validation
?>

<?php
header("Content-Type: text/html; charset=utf-8");
require_once("connect.php");
	if(isset($_POST["action"])&&($_POST["action"]=="join")){
	$query_FindUser = "SELECT username FROM member WHERE username = '".$_POST["s_id"]."'";
	$result = mysqli_query($connect,$query_FindUser);
		if(mysqli_num_rows($result)>0){
			header("Location:registration.php?errMsg=1&username=".$_POST["s_id"]);
		}else{
			$s_id = $_POST["s_id"];
			$s_pw = md5($_POST["s_pwd"]);
			$s_name = $_POST["s_name"];
			$s_email = $_POST["s_email"];
			$query_insert = sprintf("INSERT INTO member (username,pwd,name,email) VALUES ('%u','%s','%s','%s')",$s_id,$s_pw,$s_name,$s_email);
			mysqli_query($connect,$query_insert);
			header("Location: registration.php?loginStats=1");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Local bootstrap CSS & JS -->
	<link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
	<link rel="stylesheet" media="screen" href="css/reg.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Registration</title>
	<script>
			function chkform(){
				if(document.fillin.s_id.value == ""){
					alert( "ID Can't be Empty" );
					document.fillin.s_id.focus();
					return false;
				}
				uid=document.fillin.s_id.value;
				for(i=0;i<uid.length;i++){
					if(!(uid.charAt(i)>='0'&&uid.charAt(i)<='9')){
						alert("Invalid Student ID" );
						document.formJoin.m_username.focus();
						return false;
					}
				}
				if(!check_passwd(document.fillin.s_pwd.value,document.fillin.s_pwd_confirm.value)){
					document.formJoin.s_pwd.focus();
					return false;
				}
				if(document.fillin.s_name.value == ""){
					alert( "Name Can't be Empty" );
					document.fillin.s_name.focus();
					return false;
				}
				if(document.fillin.s_pwd.value == ""){
					alert( "Password Can't be Empty" );
					document.fillin.s_pwd.focus();
					return false;
				}
				if(document.fillin.s_email.value == ""){
					alert( "E-Mail Can't be Empty" );
					document.fillin.s_email.focus();
					return false;
				}
				if(!checkmail(document.fillin.s_email)){
					document.fillin.s_email.focus();
					return false;
				}
				return confirm('Submit this form ?');
		}
		function check_passwd(pw1,pw2){
		if(pw1 == ''){
			alert("Password Can't be Empty");
			return false;
		}
		for(var idx=0;idx<pw1.length;idx++){
								if(pw1.charAt(idx) == ' ' || pw1.charAt(idx) == '\"'){
									alert("Invalid Password !\n");
									return false;
								}
								if(pw1.length>20){
									alert( "Password no more than 20 letters\n" );
									return false;
								}
								if(pw1 != pw2){
									alert("Password doen't Match !\n");
									return false;
								}
							}
							if(pw1 != pw2){
									alert("Password doen't Match !\n");
									return false;
								}
							return true;
						}
						function checkmail(myEmail) {
					var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					if(filter.test(myEmail.value)){
						return true;
					}
					alert("Invalid Email addredd !");
					return false;
				}
		</script>
	</head>
<body>
<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('Create  Account Success');
window.location.href='index.php';
</script>
<?php }?>
	<div class="container-fluid">
		<div class="col-md-6 col-md-offset-3">
			<form action="" method="POST" role="form" id="fillin" name="fillin" onSubmit="return chkform();">
				<legend>Signup</legend>
				<div class="form-group">
					<!--labels-->
					<label for=""><font color="red">*</font>Student ID
					<?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
						<span class="errTips">ID <?php echo $_GET["username"];?>Has been used</span>
          			<?php }?>

					</label>
					<input type="text" class="form-control" id="" placeholder="Ex.403840308" name="s_id">
					<br/>
					<label for=""><font color="red">*</font>Name</label>
					<input type="text" class="form-control" id="" placeholder=""  name="s_name">
					<br/>
					<label for=""><font color="red">*</font>Password</label>
					<input type="password" class="form-control" id="" placeholder="" name="s_pwd">
					<br/>
					<label for=""><font color="red">*</font>Password Confirm</label>
					<input type="password" class="form-control" id="" placeholder="" name="s_pwd_confirm">
					<br/>
					<label for=""><font color="red">*</font>E-Mail</label>
					<input type="text" class="form-control" id="" placeholder="" name="s_email">
					<p style="font-style: italic"><br/><strong> Marked <font color="red">*</font> must be filled</strong></p><br/></p>
				</div>
				<div align="center">
					<input name="action" type="hidden" id="action" value="join">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-danger">Refill</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>