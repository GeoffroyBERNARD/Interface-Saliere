<?php 
	//si déjà connecté on renvoie vers l'accueil
	if(isset($_SESSION['mail'])){ header('Location:./?page=accueil');}

		//on charge le modèle et la vue
		include_once("./Modele/api.php");
		include_once("./Vue/login.html"); 

		if (isset($_POST['mail']) && isset($_POST['password'])){
			$mail = $_POST['mail'];
			$password = $_POST['password'];
		
			//on interroge l'api pour voir si le compte existe
			$resultat = customerToken($mail,$password);
		
			//Si le résultat est inferieur à 40 caractères, alors c'est un customer Token donc le compte existe
			if (strlen($resultat) < 40){
				$_SESSION['mail'] = $mail;
				$_SESSION['token'] = $resultat;
				header('Location:./?page=accueil'); 
			}
			else echo json_object_to_html($resultat);
		}
?>


