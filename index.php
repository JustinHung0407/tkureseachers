<?php require_once 'connect.php';
session_start();
if (isset($_SESSION["u_login"]) && ($_SESSION["u_login"] != "")) {
	if ($_SESSION["Level"] == 0) {
		header("Location:member/center.php");
	} elseif ($_SESSION["Level"] == 99) {
		header("Location:admin/admin.php");
	}
}
?>
<!DOCTYPE html>
<!-- Local bootstrap CSS & JS -->
<link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
<link rel="stylesheet" media="screen" href="css/signin.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>LogIn</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
	</head>
	<body>
		<?php
		$Err_Level = 0;
		if ((((@$_POST['username']) != "") && (@$_POST['password']) != "")) {
		if ((isset($_POST['username']) && isset($_POST['password']))) {
		#pull user data
		$query_RecLogin = "SELECT * FROM member WHERE username = '" . $_POST['username'] . "'";
		$RecLogin = mysqli_query($connect, $query_RecLogin);
		#push data to vars
		$row_Rec = @mysqli_fetch_assoc($RecLogin);
		$uid = $row_Rec["username"];
		$pwd = $row_Rec["pwd"];
		$group = $row_Rec["gid"];
		//pssword validation
		if (md5($_POST["password"]) == $pwd) {
			$_SESSION["u_login"] = $uid;
			$_SESSION["Level"] = $group;
			//set cookies
			if (isset($_POST["rememberme"]) && ($_POST["rememberme"] == "true")) {
				setcookie("remUSER", $_POST["username"], time() + 365 * 24 * 60);
				setcookie("remPWD", base64_encode($_POST["password"]), time() + 365 * 24 * 60);
				setcookie("isRemember", "checked=\"true\"", time() + 365 * 24 * 60);
			} else {
				if (isset($_COOKIE["remUSER"])) {
					setcookie("remUSER", $_POST["username"], time() - 100);
					setcookie("remPWD", $_POST["password"], time() - 100);
					setcookie("isRemember", "checked=\"true\"", time() - 100);
				}
			}
			header("Location:success.html");
			if ($_SESSION["Level"] == 0) {
				header("Location:member/center.php");
			}
			if ($_SESSION["Level"] == 99) {
				header("Location:admin/admin.php");
			}
		}
		if (md5($_POST["password"]) != $pwd) {
			//password error
			$Err_Level = 1;
		}
		} else {
		$Err_Level = 1;
		}
		}
		?>
		<div class="container">
			<div class="form-signin">
				<div class="panel panel-primary ">
					<div class="panel-heading">
						<h3 class="panel-title">Login</h3>
					</div>
					<div class="panel-body">
						<!--Panel content-->
						<form action="" method="POST" name="form">
							<div class="form-group">
								<?php
								if ($Err_Level == 1) {?>
								<p class="warning"><strong>Username or Password Incorrect !</strong></p><?php }
								if ($Err_Level == 2) {?>
								<p class="warning"><strong>Password Incorrect !</strong></p><?php }
								?>
								<label for="">Username</label>
								<input type="text" class="form-control" id="" placeholder="" name="username" value="<?php if (isset($_COOKIE["remUSER"])) {
								echo $_COOKIE["remUSER"];
								}
								?>">
								<br/>
								<label for="">Password</label>
								<input type="password" class="form-control" id="" placeholder="" name="password" value="<?php if (isset($_COOKIE["remPWD"])) {
								echo base64_decode($_COOKIE["remPWD"]);
								}
								?>">
								<div class="checkbox">
									<label>
										<input type="checkbox" value="true" id="rememberme" name="rememberme" <?php if (isset($_COOKIE["isRemember"])) {
										echo $_COOKIE["isRemember"];
										}
										?>">
										Remember Me
									</label>
								</div>
								<button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
								<br/>
								<!-- Wile lobby is done it needs to be fix the reload loacation -->
								<button type="button" class="btn btn-lg btn-defult btn-block" onclick="window.location.href = '#';">Guest ?</button>
								<br/>
								<a href="registration.php"><p>Registration</p></a>
								<a href="passrec.php"><p>Forget Password?</p></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
