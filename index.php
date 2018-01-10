<?php 
session_start();
include 'includes/all.php';
$erreur = 0;
	//On test si l'utilisateur veux réinitialiser la partie
if(isset($_POST['reinitialisation'])){
	session_unset();

}

	//On controle si une session existe déjà.
if(isset($_SESSION["gridRef"])) {
		//Si ell existe un récupère les donnée de la partie en session.
	$gridRef = $_SESSION["gridRef"];
	$gridPlay = $_SESSION["gridPlay"];
	$tablePvNavire = $_SESSION["tablePvNavire"];
	$compteur = $_SESSION["compteur"];
} else {
		//Sinon on initialise une nouvelle partie.
	$gridRef = InitGridRef();
	$gridPlay = InitGridPlay();
	$tablePvNavire = InitTablePv();
	$compteur = 0;

}

//Calcule du nombre de points de vie restant
$pv = 0;
foreach ($tablePvNavire as $key => $value) {
	$pv = $pv + $value;
}

	//On test si l'utilisateur a complété le formulaire de tire
if(isset($_POST['y']) && isset($_POST['x'])){

		//Test de validité des données
	if(!is_numeric($_POST['y'])){
		$erreur = 1;
	} 
	if($_POST['y'] < 1){
		$erreur = 1;
	}
	if($_POST['y'] > 10){
		$erreur = 1;
	}

	if ($erreur == 0) {

		if(strtoupper($_POST['x']) == "A" or strtoupper($_POST['x']) == "B" or strtoupper($_POST['x']) == "C" or strtoupper($_POST['x']) == "D" or strtoupper($_POST['x']) == "E" or strtoupper($_POST['x']) == "F" or strtoupper($_POST['x']) == "G" or strtoupper($_POST['x']) == "H"  or strtoupper($_POST['x']) == "I"  or strtoupper($_POST['x']) == "J") {
			
			//On valide les coordonnées
			$ordreAlpha = InitTableOrdre();
			$y = $_POST['y'] - 1;
			$x = $ordreAlpha[strtoupper($_POST['x'])]; 


			//on test si la case na pas déjà été visé
			if($gridPlay[$y][$x] != ""){
				$erreur = 2;
			} else {
				//On incrémente le compteur 
				$compteur++;
				//Si données ok on valide le tire.
				if($gridRef[$y][$x] == "") {
					$gridPlay[$y][$x] = "O";
				} else {

					$gridPlay[$y][$x] = "X";
					$navireTouche = $gridRef[$y][$x];
					//On inflige un point de dégat au bateau
					$tablePvNavire[$navireTouche]--;
					//On affiche les bâteau coulé
					$boatDown = BoatDown($tablePvNavire);
					$gridPlay = markDown($boatDown, $gridPlay, $gridRef);
					
				}
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

// Monsieur le correcteur vous pouvez décommenter la ligne d'en dessous pour tricher :p 
	// echo displayGrid($gridRef);

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
				//Si plus de pv 
				if($pv == 0){
					echo "<br><h2> Victoire en ". $compteur ." coup. Bravo !</h2><br>";
				}
				//On affichela grille
				echo displayGrid($gridPlay);

				?>
			</div>
			<div class="col-md-5"><br><h2>
			<?php 
				echo "Coup numéro " . $compteur;
			 ?></h2><br>
				<div class="jumbotron">
					<p>X = Touché.</p>
					<p>O = A l'eau.</p>
					<p>C = Coulé.</p>
				</div>
			</br>

			<?php 
				// On test si il y a une erreur , si oui on affiche une alert. 
			if ($erreur == 1) {
				echo '<div class="alert alert-danger"><STRONG>Erreur :</STRONG> Coordonnées incorrecte.</div><br>';
			}
			if ($erreur == 2) {
				echo '<div class="alert alert-danger"><STRONG>Erreur :</STRONG> Coordonnées déjà utilisé.</div><br>';
			}

			?>
<p>Entrer les coordonnées</p>
<hr>
		<form action="index.php" method="POST">

		<div class="row">
			<div class="col-md-2">
			<label>Colonne</label>
			</div>
			<div class="col-md-9">
			<input type="text" name="x"></br>
			</div>
			</div>
<br>
<div class="row">
			<div class="col-md-2">
			<label>Ligne</label>
			</div>
			<div class="col-md-9">
			<input type="text" name="y"></br>
			</div>
			</div>
		<br>
			
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
$_SESSION["compteur"] = $compteur;
?>

</body>
</html>