<?php 
$target_dir = "C:/xampp/htdocs/tkureseachers/Repos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$target_path = $target_dir . basename($_FILES['fileToUpload']['name']);
//move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_path);
//echo $_SERVER['PATH_TRANSLATED'];
echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
if(isset($_POST["fileToUpload"])) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Upload</title>
		<link rel="stylesheet" href="">
	</head>
	<body>
		<form action="" method="POST" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Submit">
		</form>
	</body>
</html>