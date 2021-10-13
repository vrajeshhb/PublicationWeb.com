<?php session_start();
if(isset($_SESSION['email'])){ 
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>
<h3>Mr./Ms <?php echo $_SESSION['email']; ?> You cannot access this files, if you have suggetions contact Vrajesh Bhimajiani (+01 514 577 3376) </h3><br>
	<a href="../index.php">GO BACK...</a>
<body>
</body>
</html>
<?php }else{
	header("location:../index.php");
} ?>