<?php 

	//Si l'utilisateur est déjà connecté, on le renvoie à l'accueil
	if(isset($_SESSION['mail'])){header('Location:./?page=accueil');} 

	//on importe le modele et la vue
	include_once("./Modele/api.php");
	include_once("./Vue/signin.html"); 
	
	//Si tout les champs sont remplis
	if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['password_check']) && isset($_POST['postal']) && isset($_POST['rue']) && isset($_POST['ville']) && isset($_POST['telephone']) && isset($_POST['pays'])){
		
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$mail = $_POST['mail'];
		$password = $_POST['password'];
		$password_check = $_POST['password_check'];
		$postal = $_POST['postal'];
		$rue = $_POST['rue'];
		$ville = $_POST['ville'];
		$telephone = $_POST['telephone'];
		$pays = $_POST['pays'];

		//Si les mots de passes correspondent
		if ($password == $password_check){	
			
			//on tente d'inscrire l'utilisateur
			$resultat = signinRequest($nom, $prenom, $mail, $password, $postal, $rue, $ville, $telephone, $pays);
	
			//si le resultat est long de plus de 400 caractères, c'est un message d'erreur dans ce cas on l'affiche, sinon on renvoie l'utilisateur à l'accueil
			if($resultat == 1) header('Location:./?page=login&inscrit=oui');
			else{
				echo strlen($resultat);
				echo json_object_to_html($resultat);
			}
			
		}


			
	}
?>
