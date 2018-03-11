<?php
	//session
	session_start();
	
	//connexion
	$con = mysqli_connect("mysql.hostinger.fr","u316444910_qygas","WeBubemaVy","u316444910_tuneh");
	
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