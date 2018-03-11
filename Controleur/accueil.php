<?php 

	//affichage basique si connecté ou non
	if (isset($_SESSION['mail'])) echo '<h1>Bienvenue ', $_SESSION['mail'], '!</h1>' ;  
	else echo '<h1>Connectez/Inscrivez vous pour configurer votre flic bouton!</h1>'
?>
 
