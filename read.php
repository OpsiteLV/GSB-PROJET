<?php 
//database constants
define('DB_HOST', 'localhost');
define('DB_USER', 'admin');
define('DB_PASS', 'admin');
define('DB_NAME', 'gsb');

	
	//connecting to database and getting the connection object
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	//creating a query `id`, `name`, `email`, `age`, `designation`, `created`
	$stmt = $conn->prepare("SELECT idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat FROM fiche_frais;");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($idVisiteur, $mois, $nbJustificatifs, $montantValide, $dateModif, $idEtat);
	
	$fiches= array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['idVisiteur'] = $idVisiteur; 
		$temp['mois'] = $mois; 
		$temp['nbJustificatifs'] = $nbJustificatifs; 
		$temp['montantValide'] = $montantValide; 
		$temp['dateModif'] = $dateModif; 
		$temp['idEtat'] = $idEtat; 
		array_push($fiches, $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($fiches);
	
?>	
