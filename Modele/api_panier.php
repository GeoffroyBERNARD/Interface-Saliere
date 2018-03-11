<?php

	/*
	LISTE DES FONCTIONS
		
		REQUETES VERS L'API
			getCartByUserId
			addProductInCart
			setProductInCart
			removeProductFromCart
			orderCart
		
	*/
	
	//récupère l'id du cart de l'utilisateur
	function getCartByUserId($id){
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://bytesclicker.online/magento/rest/V1/customers/".$id."/carts",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_HTTPHEADER => array(
				"authorization: bearer bj77pv2q3wj4wo0hqt8w5w1u734x6ksq",
				"cache-control: no-cache",
				"postman-token: 8e447333-8936-3b83-87cf-7c6101eff441"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) echo "cURL Error #:" . $err;
		else {
			$cart = str_replace('"','',$response);
			return $cart;
		}
	}
	
	//ajoute un produit au cart
	function addProductInCart($cart,$product,$quantite){
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://bytesclicker.online/magento/rest/V1/carts/".$cart."/items",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "\n{\n  \"cartItem\": {\n    \"sku\": \"".$product."\",\n    \"qty\": ".$quantite.",\n    \"quote_id\": \"".$cart."\"\n  }}",
			CURLOPT_HTTPHEADER => array(
				"authorization: bearer bj77pv2q3wj4wo0hqt8w5w1u734x6ksq",
				"cache-control: no-cache",
				"content-type: application/json",
				"postman-token: 1867dd48-c1a9-63fc-89b2-c8a7e0734037"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) echo "cURL Error #:" . $err;
		else echo json_object_to_html($response);
	}
	
	//retire un produit du cart et retourne le nombre de produit retiré
	function removeProductFromCart($cart,$product){
		
		//On récupère l'item ID du produit
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://bytesclicker.online/magento/rest/V1/carts/".$cart."/items",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "\n{\n  \"cartItem\": {\n    \"sku\": \"".$product."\",\n    \"qty\": 1,\n    \"quote_id\": \"".$cart."\"\n  }}",
			CURLOPT_HTTPHEADER => array(
				"authorization: bearer bj77pv2q3wj4wo0hqt8w5w1u734x6ksq",
				"cache-control: no-cache",
				"content-type: application/json",
				"postman-token: 1867dd48-c1a9-63fc-89b2-c8a7e0734037"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) echo "cURL Error #:" . $err;
		else {
			$json = json_decode($response);
			$itemId = $json->item_id;
			$qty = $json->qty;
		}
		
		//On le supprime
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://bytesclicker.online/magento/rest//V1/carts/".$cart.'/items/'.$itemId,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "DELETE",
			CURLOPT_HTTPHEADER => array(
				"authorization: bearer bj77pv2q3wj4wo0hqt8w5w1u734x6ksq",
				"cache-control: no-cache",
				"content-type: application/json",
				"postman-token: ef386e67-092c-ad31-b908-8aada1affe65"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) echo "cURL Error #:" . $err;
		else{
			echo "L'article n'est plus dans le panier<br>";
			return $qty;
		}
	}
	
	function setQuantityOfProductInCart($cart,$product,$qty){
		removeProductFromCart($cart,$product);
		AddProductInCart($cart,$product,$qty);
	}
	
	function removeOneProductFromCart($cart, $product){
		$qty = removeProductFromCart($cart,$product) - 2;
		if ($qty > 0) AddProductInCart($cart,$product,$qty);
	}
	
	function orderCart($cart,$user){
		
		//On commence par récupérer les informations de l'utilisateur (adresses...)
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://bytesclicker.online/magento/rest/V1/customers/".$user,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30, 
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
					"Cache-Control: no-cache",
					"Postman-Token: 8672729b-4a94-4a74-99f0-f72f3ab80195",
					"authorization: bearer bj77pv2q3wj4wo0hqt8w5w1u734x6ksq"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) echo "cURL Error #:" . $err;
		else {
			$info_client = json_decode($response);
			echo json_object_to_html($response);
			$addresses = $info_client->{'addresses'};
			$firstname = $info_client->firstname;
			$lastname = $info_client->lastname;
			$email = $info_client->email;
			$country_id = $addresses[0]->country_id;
			$street = $addresses[0]->street[0];
			$telephone = $addresses[0]->telephone;
			$postcode = $addresses[0]->postcode;
			$city = $addresses[0]->city;
		}
		
		//On utilise ces données pour valider les informations de livraison
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://bytesclicker.online/magento/rest/V1/carts/".$cart."/shipping-information",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => 
				"{\r\n    \"addressInformation\": {\r\n        \"shippingAddress\": {\r\n            \"region\": \"MH\",\r\n            \"region_id\": 0,\r\n            \"country_id\": \"".$country_id."\",\r\n            \"street\": [\r\n                \"".$street."\"\r\n            ],\r\n            \"company\": \"abc\",\r\n            \"telephone\": \"".$telephone."\",\r\n            \"postcode\": \"".$postcode."\",\r\n            \"city\": \"".$city."\",\r\n            \"firstname\": \"".$firstname."\",\r\n            \"lastname\": \"".$lastname."\",\r\n            \"email\": \"".$email."\",\r\n            \"prefix\": \"address_\",\r\n            \"region_code\": \"MH\",\r\n            \"sameAsBilling\": 1\r\n        },\r\n        \"billingAddress\": {\r\n            \"region\": \"MH\",\r\n            \"region_id\": 0,\r\n            \"country_id\": \"".$country_id."\",\r\n            \"street\": [\r\n                \"".$street."\"\r\n            ],\r\n            \"company\": \"abc\",\r\n            \"telephone\": \"".$telephone."\",\r\n            \"postcode\": \"".$postcode."\",\r\n            \"city\": \"".$city."\",\r\n            \"firstname\": \"".$firstname."\",\r\n            \"lastname\": \"".$lastname."\",\r\n            \"email\": \"".$email."\",\r\n            \"prefix\": \"address_\",\r\n            \"region_code\": \"MH\"\r\n        },\r\n        \"shipping_method_code\": \"flatrate\",\r\n        \"shipping_carrier_code\": \"flatrate\"\r\n    }\r\n}",
			CURLOPT_HTTPHEADER => array(
				"authorization: Bearer bj77pv2q3wj4wo0hqt8w5w1u734x6ksq",
				"cache-control: no-cache",
				"content-type: application/json",
				"postman-token: ae94afc0-a2a4-d2b5-1740-2cc1335e76f3"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) echo "cURL Error #:" . $err;
		else echo json_object_to_html($response);
		
		//puis on valide la commande
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://bytesclicker.online/magento/rest/V1/carts/".$cart."/order",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "PUT",
			CURLOPT_POSTFIELDS => "{\r\n    \"paymentMethod\": {\r\n        \"method\": \"checkmo\"\r\n    }\r\n}",
			CURLOPT_HTTPHEADER => array(
				"authorization: Bearer bj77pv2q3wj4wo0hqt8w5w1u734x6ksq",
				"cache-control: no-cache",
				"content-type: application/json",
				"postman-token: eb1cab2a-a6a0-fb38-7796-8f79cc4495d5"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) echo "cURL Error #:" . $err;
		else {
			echo json_object_to_html($response);
		}			
}





?>