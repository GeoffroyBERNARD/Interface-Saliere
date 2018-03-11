<?php
	include_once("./Modele/api.php");
	include_once("./Modele/api_panier.php");
	include_once("./Modele/bdd.php");

	//Si le hash est renseigné et que le clic est bon
	if(isset($_GET['hash']) &&  isset($_GET['clic'])){
		$hash = $_GET['hash'];
		$clic = $_GET['clic'];
		
		//On regarde si le hash existe
		$results = getSettingsByHash($hash,$con);

		
		//Si il existe lors
		if (count($results) != 0){
			
			//on recupère l'id de l'utilisateur
			$user = $results[0]->id_customer;
			//On recupère l'action et le produit correspondant au clic associé à l'url
			if ($clic == "1"){
				$action = $results[0]->action_simple;
				$produit = $results[0]->id_produit_simple;	
			}
			else if ($clic == "2"){
				$action = $results[0]->action_double;
				$produit = $results[0]->id_produit_double;	
			}
			else if ($clic == "3"){
				$action = $results[0]->action_long;
				$produit = $results[0]->id_produit_long;	
			}
			
			//on récupère l'id du cart client
			$cart = getCartByUserId($user);

			if($action == "1") 	setQuantityOfProductInCart($cart,$produit,1);
			else if($action == "2") addProductInCart($cart,$produit,1);
			else if($action == "3") removeProductFromCart($cart,$produit);
			else if($action == "4") orderCart($cart,$user);
			else if($action == "5")	removeOneProductFromCart($cart,$produit);
		}
	}
?>