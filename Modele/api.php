<?php

	/*
	LISTE DES FONCTIONS
	
		DIVERS
			json_object_to_html 	retourne un json sous forme lisible
		
		REQUETES VERS L'API
			customerToken			verifie si un compte existe
			signinRequest			inscrit un utilisateur
			getProduct				récupère la liste des produits
			getIdbyMail				récupère l'id du client avec son mail
		
	*/

	//Renvoie un json donné sous forme lisible facilement
	function json_object_to_html($json_object_string){

		$json_object=json_decode($json_object_string);
		if(!is_object($json_object)) {
			if (is_array($json_object)){
				$result="[ <br>";
				foreach($json_object as $json_obj){
					$result.="<div style='margin-left:30px'>".json_object_to_html( json_encode( $json_obj ) )."</div>";
					if(end($json_object)!=$json_obj) $result.=",";
				}
				return $result."  ] <br>";
			}
			else return json_decode($json_object_string);

		}
		$result = "";
		foreach($json_object as $key => $value){
			$str_value=json_object_to_html( json_encode($value) );
			$result.="<span><span style='font-weight: bold'>$key : </span>$str_value</span><br>";
		}
		return $result;
	}

	//Renvoie le résultat de la requête, si l'utilisateur avec $mail et $password existe, alors  ce sera un customer token, sinon ce sera un message d'erreur
	function customerToken($mail,$password){			
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://bytesclicker.online/magento/rest/V1/integration/customer/token",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"username\"\r\n\r\n".$mail."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\n".$password."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
			CURLOPT_HTTPHEADER => array(
				"Cache-Control: no-cache",
				"Postman-Token: abbcabd6-295e-459d-8386-2746f91ed043",
				"content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) echo "cURL Error #:" . $err;
		else return $response;
	}
	
	//Inscrit l'utilisateur (prend en paramètre toutes ses infos) Renvoie (int) 1 si l'inscription est réussie, sinon renvoie le message d'erreur
	function signinRequest($nom, $prenom, $mail, $password, $postal, $rue, $ville, $telephone, $pays){
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://bytesclicker.online/magento/rest/V1/customers",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "{\r\n\t\"customer\": {\r\n\t\t\"email\": \"".$mail."\",\r\n\t\t\"firstname\": \"".$prenom."\",\r\n\t\t\"lastname\": \"".$nom."\",\r\n\t\t\"addresses\": [{\r\n\t\t\t\"defaultShipping\": true,\r\n\t\t\t\"defaultBilling\": true,\r\n\t\t\t\"firstname\": \"".$prenom."\",\r\n\t\t\t\"lastname\": \"".$nom."\",\r\n\t\t\t\r\n\t\t\t\"postcode\": \"".$postal."\",\r\n\t\t\t\"street\": [\"".$rue."\"],\r\n\t\t\t\"city\": \"Purchase\",\r\n\t\t\t\"telephone\": \"".$telephone."\",\r\n\t\t\t\"countryId\": \"".$pays."\"\r\n\t\t}]\r\n\t},\r\n  \"password\": \"".$password."\"\r\n}",
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer https://www.owasp.org/index.php/Top_10-2017_Top_10",
				"Cache-Control: no-cache",
				"Content-Type: application/json",
				"Postman-Token: db98dab3-bc8c-4dc9-a850-f7270c7059c8"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) echo "cURL Error #:" . $err;
		else {
			if (strlen($response) < 400) return $response;	
			else return 1;
		}
	}
	
	//Retourne la liste des produit et la converti de json à objet
	function getProduct(){
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://bytesclicker.online/magento/rest/V1/products/?searchCriteria=",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"authorization: Bearer https://www.owasp.org/index.php/Top_10-2017_Top_10",
			"cache-control: no-cache",
			"postman-token: 8c705935-01e0-0174-c683-b4e050b29ce8"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) echo "cURL Error #:" . $err;
		else {
			$parsed_json = json_decode($response);
			return $liste_produit = $parsed_json->{'items'};
		}
	}
	
	//Retourne l'id d'un client grâce à son mail
	function getIdbyMail($mail){
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://bytesclicker.online/magento/rest/V1/customers/search/?searchCriteria=",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"authorization: bearer https://www.owasp.org/index.php/Top_10-2017_Top_10",
				"cache-control: no-cache",
				"postman-token: e1db1570-0a14-deed-9f41-2e0fc185b2ae"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) echo "cURL Error #:" . $err;
		else {
			$parsed_json = json_decode($response);
			$customers = $parsed_json->{'items'};
			$id = 0;
			for ($i= 0; $i < sizeof($customers); $i++) {
				if ($customers[$i]->email == $mail){
					return $customers[$i]->id;
				}
			}
		}
	}
	
?>
