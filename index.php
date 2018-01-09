	<?php 
	session_start();
	include 'includes/all.php';
	if (isset($_SESSION["reinit"]) && $_SESSION["reinit"] == 1) {
		initGame();
	}

	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<title>
			Bataille Navale
		</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<link href="css/style.css" rel="stylesheet"/>

	</head>
	<body>
		<br> 
		<br>
		<?php 
		$randomOrigine = rand(0,10 - PorteAvions);
		echo $randomOrigine;

		echo displayGrid($_SESSION["gridRef"]);
		?>
		<div class="container">
			<h1>Bataille Navale</h1>
			<div class="row">
				<div class="col-md-7">

					<br> 
					<form action="index.php" method="POST">
						<input type="hidden" name="reinit" value="1">
						<input type="submit" name="reinitialisation" value="Réinitialiser" class="btn btn-success">
					</form>
					<?php 
//On test si une partie est déjà en cours.
					if(isset($_SESSION["newsession"]) && $_SESSION["newsession"]  != true){

						echo displayGrid($_SESSION["gridPlay"]);
					} else {
						initGame();
						echo displayGrid($_SESSION["gridPlay"]);
					}
					?>
				</div>
				<div class="col-md-5">
					<div class="jumbotron">
						<p>X = Touché.</p>
						<p>O = A l'eau.</p>
						<p>C = Coulé.</p>
					</div>
				</br>
				<div class="alert alert-danger"><STRONG>Erreur :</STRONG> Coordonnées incorrecte.</div>
			</br>
			<form action="index.php" method="POST">
				<label>Colonne</label>
				<input type="text" name="y"></br>
				<label>Ligne</label>
				<input type="text" name="x"></br>
				<input type="submit" name="valider" value="Valider" class="btn btn-primary">
			</form>

		</div>
	</div>
</div>









</body>
</html>