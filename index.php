<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php
		include 'includes/all.php';
		session_start();

	?>
	<title>
		Bataille Navale
	</title>

		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<?php 

//On test si une partie est déjà en cours.
if($_SESSION["newsession"]  != true){
	initGame();
	echo displayGrid($_SESSION["gridPlay"]);
} else {
echo displayGrid($_SESSION["gridPlay"]);
}



 ?>








</body>
</html>