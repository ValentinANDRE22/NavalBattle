<?php 


//Function de création du tableau de référence
//
//
//@return array contenant les coordonées des bateaux
function InitGridRef(){

	//Initialisation du tableau contenant les coordonées des bateaux
  $gridRef = [];
  $gridRef[0] = array('','','','','','','','','','');
  $gridRef[1] = array('','','','','','','','','','');
  $gridRef[2] = array('','','','','','','','','','');
  $gridRef[3] = array('','','','','','','','','','');
  $gridRef[4] = array('','','','','','','','','','');
  $gridRef[5] = array('','','','','','','','','','');
  $gridRef[6] = array('','','','','','','','','','');
  $gridRef[7] = array('','','','','','','','','','');
  $gridRef[8] = array('','','','','','','','','','');
  $gridRef[9] = array('','','','','','','','','','');

  $gridRef = placeBoats($gridRef);

  return $gridRef;
}

//Function de création du tableau de jeu
//
//@return array contenant les résultats des tires effectué.
function InitGridPlay(){

	//Initialisation du tableau contenant les résultats des tires effectué.
  $gridPlay = [];
  $gridPlay[0] = array('','','','','','','','','','');
  $gridPlay[1] = array('','','','','','','','','','');
  $gridPlay[2] = array('','','','','','','','','','');
  $gridPlay[3] = array('','','','','','','','','','');
  $gridPlay[4] = array('','','','','','','','','','');
  $gridPlay[5] = array('','','','','','','','','','');
  $gridPlay[6] = array('','','','','','','','','','');
  $gridPlay[7] = array('','','','','','','','','','');
  $gridPlay[8] = array('','','','','','','','','','');
  $gridPlay[9] = array('','','','','','','','','','');

  return $gridPlay;

}

//Function de création du tableau des points de vies
//
//@return array contenant les points de vie initial de chaque bateau
function InitTablePv()
{

 //Initialisation du tableau des points de vie des navires
  $tablePvNavire =  array(
    'pa' => PorteAvions, 
    'c'  => Croiseur,
    'ct' => ContreTorpilleur,
    'sm' => SousMarin,
    't'  => Torpilleur,
    );

  return $tablePvNavire;
}

//Function qui retourne les bateaux coulé.
//
//@param le tableau des points de vie
//@return array contenant les bateaux coulé.
function BoatDown($tablePvNavire)
{
  $boatDown = [];

  foreach ($tablePvNavire as $key => $value) {
    if($value == 0){
      $boatDown[] = $key;
    }
  }

  return $boatDown;
}


//Function qui marque les bateaux coulé.
//
//@param le tableau des bateaux coulé, et le tableau de jeu et le tableau de ref
//@return le tableau de jeu
function markDown($boatDown, $gridPlay, $gridRef)
{
  for ($y=0; $y < 10; $y++) { 
     
      for ($x=0; $x < 10; $x++) { 
        foreach ($boatDown as $key => $value) {
          if($gridRef[$y][$x] == $value){
              $gridPlay[$y][$x] = "C";
          }
        }
     }
   }
  return $gridPlay;
}


//Function de création du tableau de l'ordre alphabétique
//
//@return array contenant la position dans l'alphabet d'une lettre
function InitTableOrdre()
{

 //Initialisation du tableau des ordres
  $ordreAlpha =  array(
    'A' => 0, 
    'B' => 1,
    'C' => 2,
    'D' => 3,
    'E' => 4,
    'F' => 5, 
    'G' => 6,
    'H' => 7,
    'I' => 8,
    'J' => 9,
    );

  return $ordreAlpha;
}

//Function de placement des bateaux
//
//@param tableau de référence vide
//@return tableau contenant les coordonées des bateaux
function placeBoats($gridRef)
{

 //Placement du porte avions
  $codeBoat = 'pa';
  $lengthBoat = PorteAvions;
  $gridRef = placeBoat($codeBoat, $lengthBoat, $gridRef);


  //Placement du croiseur
  $codeBoat = 'c';
  $lengthBoat = Croiseur;
  $gridRef = placeBoat($codeBoat, $lengthBoat, $gridRef);

  //Placement du contre torpilleur
  $codeBoat = 'ct';
  $lengthBoat = ContreTorpilleur;
  $gridRef = placeBoat($codeBoat, $lengthBoat, $gridRef);

  //Placement du sous marin
  $codeBoat = 'sm';
  $lengthBoat = SousMarin;
  $gridRef = placeBoat($codeBoat, $lengthBoat, $gridRef);

  //Placement du torpilleur
  $codeBoat = 't';
  $lengthBoat = Torpilleur;
  $gridRef = placeBoat($codeBoat, $lengthBoat, $gridRef);


  return $gridRef;
}


//Fonction qui place un bateau
//
//@param le code du bateau et son nombre de case et le tableau pour placer le bateau
//@return le tableau avec le bateau placé
function placeBoat($codeBoat, $lengthBoat, $gridRef)
{
 
    $countError = 1;
   do {
     $countError = 0;
     $tableCoords = [];

    //Horrizontale ou verticale
     $randomOrientation = rand(1,2);
    //Si 1 alors verticale
     if($randomOrientation == 1) {

      $x = rand(0,9);
      $randomY = rand(0,10 - $lengthBoat);
      $YLimite = $randomY + $lengthBoat;

     
      for ($y = $randomY; $y < $YLimite; $y++) { 
       $tableCoords[] = array($y,$x);
     }
   }
    //Si 2 alors horizontale
   if ($randomOrientation == 2) {
    $y = rand(0,9);
    $randomX = rand(0,10 - $lengthBoat);
    $XLimite = $randomX + $lengthBoat;
    for ($x = $randomX; $x < $XLimite; $x++) { 
     $tableCoords[] = array($y,$x);

   }
  }
  //Controle de la disponibilité des cases
  foreach ($tableCoords as $coord) {
    if($gridRef[$coord[0]][$coord[1]] != ""){
      $countError ++;
    }
  }

  }  while ($countError != 0);

  foreach ($tableCoords as $coord) {
    $gridRef[$coord[0]][$coord[1]] = $codeBoat;
  }

  return $gridRef;
}


//-------------------------------- Fontcions d'affichage -----------------------------


//Function affichant le tableau de jeu.
//
//@param $grid un tableau (10x10)
//@return $out une chaine de caractère contenant le code html de l'affichage du tableau
function displayGrid($grid)
{
	$out =' <table class="table">
  <thead>
    <tr>
      <th> </th>
      <th>A</th>
      <th>B</th>
      <th>C</th>
      <th>D</th>
      <th>E</th>
      <th>F</th>
      <th>G</th>
      <th>H</th>
      <th>I</th>
      <th>J</th>
    </tr>
  </thead>
  <tbody>';

    for ($y=0; $y < 10; $y++) { 
      $out .='  <tr>
      <td>'.($y + 1).'</td>';
      for ($x=0; $x < 10; $x++) { 
        if($grid[$y][$x] == "X") {
          $out .= '<td style="color:red"><STRONG>X</STRONG></td>';
        }elseif ($grid[$y][$x] == "O") {
          $out .= '<td style="color:blue"><STRONG>O</STRONG></td>';
        }elseif ($grid[$y][$x] == "C") {
          $out .= '<td style="color:black"><STRONG>C</STRONG></td>';
        } else {
          $out .= '<td>'.$grid[$y][$x].'</td>';
        }
       
     }
     $out .= '</tr>';
   }

   $out .='</tbody>
 </table>';  

 return $out;
}



?>