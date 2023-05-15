<?php 

/* 
version du fichier : 2.1

modifications : 
	- utilisation de PDO
	- de la requête pour afficher le nom, prenom du visiteur
	- suppression du WHERE
*/

//database constants
define('DB_HOST', "localhost");
define('DB_USER', 'admin');
define('DB_PASS', 'admin');
define('DB_NAME', 'gsb');
define('DB_PORT', '3306');
define('DB_CHARSET', 'utf8');

	try {
		$dsn = "mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";charset=".DB_CHARSET;
		$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	
		$conn = new PDO($dsn, DB_USER, DB_PASS, $options);
		$req = $conn->prepare("SELECT visiteur.nom, visiteur.prenom, idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat
								FROM fiche_frais
								INNER JOIN visiteur ON fiche_frais.IdVisiteur=visiteur.id
								;");
		$req->execute();

		$fiches= array(); 
	
		//traversing through all the result 
		while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
			$temp = array();
			$temp['nom'] = $ligne['nom']; 
			$temp['prenom'] = $ligne['prenom']; 
			$temp['idVisiteur'] = $ligne['idVisiteur']; 
			$temp['mois'] = $ligne['mois']; 
			$temp['nbJustificatifs'] = $ligne['nbJustificatifs']; 
			$temp['montantValide'] = $ligne['montantValide']; 
			$temp['dateModif'] = $ligne['dateModif']; 
			$temp['idEtat'] = $ligne['idEtat']; 
			array_push($fiches, $temp);
		}	
		//displaying the result in json format 
		echo json_encode($fiches);

	}catch(PDOException $e) {
	echo "Erreur : " . $e->getMessage();
  }
	
?>	
