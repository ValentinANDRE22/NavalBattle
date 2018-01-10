	<?php 
	session_start();
	include 'includes/all.php';
	$erreur = 0;
	//On test si l'utilisateur veux réinitialiser la partie
	if(isset($_POST['reinitialisation'])){
		echo 'il y a eu réinit';
		session_unset();

	}

	//On controle si une session existe déjà.
	if(isset($_SESSION["gridRef"])) {
		//Si ell existe un récupère les donnée de la partie en session.
		echo 'il y a une cession';
		$gridRef = $_SESSION["gridRef"];
		$gridPlay = $_SESSION["gridPlay"];
		$tablePvNavire = $_SESSION["tablePvNavire"];
	} else {
		//Sinon on initialise une nouvelle partie.
		$gridRef = InitGridRef();
		$gridPlay = InitGridPlay();
		$tablePvNavire = InitTablePv();

	}

	//On test si l'utilisateur a complété le formulaire de tire
	if(isset($_POST['y']) && isset($_POST['x'])){

		//Test de validité des données
		if(!is_numeric($_POST['y'])){
			$erreur = 1;
		} 
		if($_POST['y'] < 1){
			echo "errrrreur";
			$erreur = 1;
		}
		if($_POST['y'] > 10){
			echo "errr";
			$erreur = 1;
		}

		if ($erreur == 0) {

			if(strtoupper($_POST['x']) == "A" or strtoupper($_POST['x']) == "B" or strtoupper($_POST['x']) == "C" or strtoupper($_POST['x']) == "D" or strtoupper($_POST['x']) == "E" or strtoupper($_POST['x']) == "F" or strtoupper($_POST['x']) == "G" or strtoupper($_POST['x']) == "H"  or strtoupper($_POST['x']) == "I"  or strtoupper($_POST['x']) == "J") {
			//
			$ordreAlpha = InitTableOrdre();
			$y = $_POST['y'] - 1;
			$x = $ordreAlpha[strtoupper($_POST['x'])]; 

			var_dump($y);
			var_dump($x);



			$gridPlay[$y][$x] = $gridRef[$y][$x];
			if($gridRef[$y][$x] == "") {
				$gridPlay[$y][$x] = "O";
			}
		} else {
			$erreur = 1;
		}
		}
		
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

		echo displayGrid($gridRef);
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
					echo displayGrid($gridPlay);

					?>
				</div>
				<div class="col-md-5">
					<div class="jumbotron">
						<p>X = Touché.</p>
						<p>O = A l'eau.</p>
						<p>C = Coulé.</p>
					</div>
				</br>

				<?php 
				// On test si il y a une erreur , si oui on affiche une alert. 
				if ($erreur == 1) {
					echo '<div class="alert alert-danger"><STRONG>Erreur :</STRONG> Coordonnées incorrecte.</div>';
				}

				 ?>
				
			</br>
			<form action="index.php" method="POST">

				<label>Colonne</label>
				<input type="text" name="x"></br>
				<label>Ligne</label>
				<input type="text" name="y"></br>
				<input type="submit" name="valider" value="Tirer" class="btn btn-primary">
			</form>

		</div>
	</div>
</div>







<?php 
// On garde en session les donnèes de la partie.
$_SESSION["gridRef"] = $gridRef;
$_SESSION["gridPlay"] = $gridPlay ;
$_SESSION["tablePvNavire"] = $tablePvNavire;
?>

</body>
</html>