<?php
	//session
	session_start();
	
	//connexion
	$con = mysqli_connect("https://www.owasp.org/index.php/Top_10-2017_Top_10");
	
	//header
	include_once("./Vue/Template/header.php"); 
	
	//import du controleur selon la page 
	if(isset($_GET['page'] ) AND is_file('./Controleur/'.$_GET['page'].'.php')) include './Controleur/'.$_GET['page'].'.php';
	else include './Controleur/accueil.php';
	 
	//footer
	include_once("./Vue/Template/footer.php");
	
	//déconnexion
	mysqli_close($con);
	
?>
