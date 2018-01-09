<?php 

//Function d'initialisation de la partie avec la création des tableaux
// et le placement des bateaux.
//
// 
function initGame(){

	$_SESSION["newsession"]= true;

	//Initialisation du tableau contenant les coordonées des bateaux
  $gridRef = array();
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

  $gridRef = placeBoat($gridRef);

  $_SESSION["gridRef"]= $gridRef;


	//Initialisation du tableau contenant les résultats des tires effectué.
  $gridPlay = array();
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

  $_SESSION["gridPlay"]= $gridPlay;

	//Initialisation du tableau des points de dégats des navires
  $tablePvNavire =  array(
    'pa' => PorteAvions, 
    'c'	 => Croiseur,
    'ct' => ContreTorpilleur,
    'sm' => SousMarin,
    't'  => Torpilleur,
    );

  $_SESSION["tablePvNavire"] = $tablePvNavire;
}

//Function de placement des bateaux
//
//@param tableau de référence vide
//@return tableau contenant les coordonées des bateaux
function placeBoat($gridRef)
{

  //Placement du porte avions
  //Horrizontale ou verticale
  $randomOrientation = rand(1,2);
  //Si 1 alors verticale
  if($randomOrientation == 1) {

    $x = rand(0,9);
    $randomY = rand(0,9 - PorteAvions);
    $YLimite = $randomY + PorteAvions;

    for ($y = $randomY; $y < $YLimite; $y++) { 
      var_dump($y);
      var_dump($x);

      $gridRef[$y][$x] = 'pa';
      var_dump($gridRef[$y][$x]);
    }
  }
  //Si 2 alors horizontale
  if ($randomOrientation == 2) {
    $y = rand(0,9);
    $randomX = rand(0,9 - PorteAvions);
    $XLimite = $randomX + PorteAvions;
    for ($x = $randomX; $x < $XLimite; $x++) { 
      var_dump($y);
      var_dump($x);

      $gridRef[$y][$x] = 'pa';
    }
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
       $out .= '<td>'.$grid[$y][$x].'</td>';
     }

     $out .= '</tr>';
   }



   $out .='</tbody>
 </table>';  

 return $out;
}



?>