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
	<title>SALT ME</title>
	
	</head>
<body>
	<div class="container-fluid">
		<div class="col-md-6 col-md-offset-3">
			<form action="" method="POST" role="form" id="fillin" name="fillin">
				<legend>MD5</legend>
				<div class="form-group">
					<input type="text" class="form-control" id="" name="salt">
					<br/>
					<?php if(isset($_POST["salt"])){
						print("MD5 : ");
						print(md5($_POST["salt"]));
					}
					?>
					
				</div>
				<div align="center">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-danger">Refill</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>