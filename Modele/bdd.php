<?php

	/*
	LISTE DES FONCTIONS
	
		REQUETES VERS LA BDD
			getSettingsById			recupère un utilisateur
			getSettingsByHash		recupère un utilisateur
			addSettings				initialise un utilisateur
			updateSettings			met à jour un utilisateur
		
	
		$con correspond toujours à la connexion à la bdd
	*/
	
	//Retourne les options de l'utilisateur avec son id
	function getSettingsById($id,$con){
		$results = [];
		$sql= "SELECT * FROM `customer_settings` WHERE `id_customer` = '$id'"; 
		$req= $con->query($sql); 
		if($result=$req){
			while($line= mysqli_fetch_object($result)) {
				array_push($results, $line);
			}
		}
		return $results;
	}
	
	//Retourne les options de l'utilisateur avec son hash
	function getSettingsByHash($hash,$con){
		$results = [];
		$sql= "SELECT * FROM `customer_settings` WHERE `hash` = '$hash'"; 
		$req= $con->query($sql); 
		if($result=$req){
			while($line= mysqli_fetch_object($result)) {
				array_push($results, $line);
			}
		}
		return $results;
	}
	
	//Initialise un utilisateur dans la bdd et retourne ses options
	function addSettings($id, $p1, $p2, $p3, $con){
		$id=$id;
		$act1= 1;
		$prod1=1;
		$act2= 1;
		$prod2=1;
		$act3=1;
		$prod3=1;
		$hash= substr(session_id(),0,15);
		$mailing = 0;
			 
		$sql = "INSERT INTO `customer_settings`(`id_customer`, `action_simple`, `id_produit_simple`, `action_double`, `id_produit_double`, `action_long`, `id_produit_long`, `notifications_mail`, `hash`, `prix_simple`, `prix_double`, `prix_long`) VALUES ($id,$act1,$prod1,$act2,$prod2,$act3,$prod3,$mailing,'$hash',$p1,$p2,$p3)";
		$req= $con->query($sql);   
			
		$results = [];
		$sql= "SELECT * FROM `customer_settings` WHERE `id_customer` = '$id'"; 
		$req= $con->query($sql); 
		if($result=$req){
			while($line= mysqli_fetch_object($result)) {
				array_push($results, $line);
			}
		}
		return $results;
	}
	
	//Met à jour les options d'un utilisateur avec les infos spécifiées en entrée
	function updateSettings($id, $act1, $act2, $act3, $prod1, $prod2, $prod3, $mailing, $p1, $p2, $p3, $con){
		
		$sql = "UPDATE `customer_settings` SET `action_simple` = '$act1', `id_produit_simple` = '$prod1',
       `action_double` = '$act2', `id_produit_double` = '$prod2', `action_long` = '$act3', `id_produit_long` = '$prod3',
        `notifications_mail` = '$mailing',`prix_simple` = '$p1', `prix_double` = '$p2', `prix_long` = '$p3'
          WHERE `customer_settings`.`id_customer` = $id;";
		
		$req= $con->query($sql);   
	}
	


 ?>