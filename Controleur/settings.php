<?php 
	//On test si l'utilisateur est connecté avant tout
	if(!isset($_SESSION['mail'])){header('Location:./?page=login');} 
	$mail = $_SESSION['mail']; 
	
	//on importe les modele et la vue
	include_once("./Modele/api.php");
	include_once("./Modele/bdd.php");
		
	//on recupère la liste des produits
	$date_jour = getProduct();

	//on recupère l'id de l'utilisateur
	$id = getIdbyMail($mail);

	//on recupère les options de l'utilisateur
	$settings = getSettingsById($id,$con);
	
	//Si l'utilisateur n'est pas encore présent dans la bdd gérant le bouton alors on l'initialise (et on lui attribut un hash)
	if (count($settings) == 0){
		$p1= $date_jour[1]->price;
		$p2=$date_jour[1]->price;
		$p3=$date_jour[1]->price;
		addSettings($id,$p1,$p2,$p3,$con);
	}
		
	//on passe les valeurs dans le formulaire
	$formulaire = $settings;	

	//on importe la vue maintenant qu'on dispose des informations nécessaires
	include_once("./Vue/settings.php"); 	



	//Si le formulaire est valide
	if (isset($_POST['action_simple']) && isset($_POST['action_double']) && isset($_POST['action_long']) && isset($_POST['produit_simple']) && isset($_POST['produit_double']) && isset($_POST['produit_long'])){

		if(isset($_POST['mailing']))$mailing = 1;
		else $mailing = 0;
		$id=$id;
		$act1= $_POST['action_simple'];
		$prod1=$_POST['produit_simple'];
		$act2= $_POST['action_double'];
		$prod2=$_POST['produit_double'];
		$act3=$_POST['action_long'];
		$prod3=$_POST['produit_long'];
		$mailing = $mailing;
		$p1= $date_jour[intval($_POST['produit_simple'])-1]->price;
		$p2=$date_jour[intval($_POST['produit_double'])-1]->price;
		$p3=$date_jour[intval($_POST['produit_long'])-1]->price;
		
		//on met à jour la bdd avec les infos du formulaire
		updateSettings($id, $act1, $act2, $act3, $prod1, $prod2, $prod3, $mailing, $p1, $p2, $p3, $con);

		//on refresh la page pour bien mettre à jour les infos
		echo '<script> window.location.replace("http://bytesclicker.online/interfaceMVC/?page=settings"); </script>';
	}

?>








