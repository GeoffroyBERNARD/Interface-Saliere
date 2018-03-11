
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_GET['page']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./MDL/main.css" />
	<link rel="stylesheet" href="./MDL/material.min.css">
<script src="./MDL/material.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <header class="mdl-layout__header"><br>

	<div class="mdl-layout__header-row">
     
      
	
	
	<?php //là c'est juste pour que si c'est déjà l'accueil alors l'image redirige pas vers l'accueil, ça fait pro
	if(isset($_GET['page']) && $_GET['page'] != "accueil")echo'<a class="mdl-navigation__link"href="./?page=accueil">'; ?>
	<span><img class="mdl-layout-title" height=40 width=150 src="./MDL/logo.svg"></span>
	<?php if(isset($_GET['page']) && $_GET['page'] != "accueil")echo'</a>'; ?>
	 <!-- Add spacer, to align navigation to the right -->
	 <div class="mdl-layout-spacer"></div>
	<!-- Navigation. We hide it in small screens. -->
	<nav class="mdl-navigation mdl-layout--large-screen-only	">
	<a class="mdl-navigation__link" href="http://bytesclicker.online/magento/">Retour &agrave; la Sali&egrave;re</a>
	
	<?php 
	//si quelqu'un est connecté/viens de s'inscrire
	if (isset ($_SESSION['mail'])){
		echo '<a class="mdl-navigation__link" href="./?page=settings">Paramétrage</a>';
		echo '<a class="mdl-navigation__link" href="./?page=unlog">Se déconnecter</a>';
		

		
	}
	
	else{ 
		echo '<a class="mdl-navigation__link" href="./?page=signin">Creer un compte</a>';
		echo '<a class="mdl-navigation__link" href="./?page=login">Se connecter</a>';
	}
	?>
	</nav>
	</div>

</header>
<div class="mdl-layout__drawer">
    <span><img class="mdl-layout-title" height=40 width=150 src="./MDL/logo.svg"></span>
	<?php if(isset($_GET['page']) && $_GET['page'] != "accueil")echo'</a>'; ?>
    <nav class="mdl-navigation">
	  <a class="mdl-navigation__link" href="http://bytesclicker.online/magento/">Retour &agrave; la Sali&egrave;re</a>
	  <?php 
	//si quelqu'un est connect�/viens de s'inscrire
	if (isset ($_SESSION['mail'])){
		echo '<a class="mdl-navigation__link" href="./?page=settings">Paramétrage</a>';
		echo '<a class="mdl-navigation__link" href="./?page=unlog">Se déconnecter</a>';
	}
	
	else{ 
		echo '<a class="mdl-navigation__link" href="./?page=signin">Creer un compte</a>';
		echo '<a class="mdl-navigation__link" href="./?page=login">Se connecter</a>';
	}
	?>

    </nav>
  </div>
</head>
<body class="mdl-layout mdl-js-layout mdl-color--grey-100">
<main class="mdl-layout__content">