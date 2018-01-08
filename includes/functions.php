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