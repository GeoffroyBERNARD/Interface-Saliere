<div style="width:110%;" class="mdl-card mdl-shadow--6dp">
			<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
				<h2 class="mdl-card__title-text">Param&egrave;tres</h2>
			</div>
	  	<div class="mdl-card__supporting-text">
<form method="POST"> 

<table class="mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp">
<thead>
	<tr>
		<th>Type de clic</th>
		<th>Action</th>
		<th>Produit</th>
		<th>Url</th>
	</tr>
</thead>
<tbody>
	<tr>
		<th>Simple</th>
		<th><select id="action_simple" name="action_simple" onchange="update_url()">
		<option value="2" <?php if($formulaire[0]->action_simple== '2'){echo "selected";} ?> >Ajouter une unit&eacute; de</option>
		<option value="5"  <?php if($formulaire[0]->action_simple== '5'){echo "selected";} ?> >Retirer une unit&eacute; de</option>
		<option value="1" <?php if($formulaire[0]->action_simple== '1'){echo "selected";} ?> >Mettre &agrave; 1 la quantit&eacute; de</option>
		<option value="3" <?php if($formulaire[0]->action_simple== '3'){echo "selected";} ?> >Supprimer le produit du panier</option>
		<option value="4"  <?php if($formulaire[0]->action_simple== '4'){echo "selected";} ?> >Commander le contenu du panier</option>
	</select></th>
		<th><select  name="produit_simple" id="produit_simple" onchange="update_url()">
		<?php
		for ($i= 0; $i < sizeof($date_jour); $i++) {
			echo '<option ';
			 if(intval($formulaire[0]->id_produit_simple)== $i + 1){echo "selected ";} 
			echo 'value="'.$date_jour[$i]->sku.'">'.$date_jour[$i]->name."</option>";
			}
			?>
	</select></th>
	<th id="url_simple"><?php echo 'http://bytesclicker.online/interfaceMVC/?page=clic&clic=1&hash='.$formulaire[0]->hash;?></th>
	</tr>
	
	<tr>
		<th>Double</th>
		<th><select name="action_double" id="action_double" onchange="update_url()">
		<option value="2" <?php if($formulaire[0]->action_double== '2'){echo "selected";} ?> >Ajouter une unit&eacute; de</option>
		<option value="5"  <?php if($formulaire[0]->action_double== '5'){echo "selected";} ?> >Retirer une unit&eacute; de</option>
		<option value="1" <?php if($formulaire[0]->action_double== '1'){echo "selected";} ?> >Mettre &agrave; 1 la quantit&eacute; de</option>
		<option value="3" <?php if($formulaire[0]->action_double== '3'){echo "selected";} ?> >Supprimer le produit du panier</option>
		<option value="4"  <?php if($formulaire[0]->action_double== '4'){echo "selected";} ?> >Commander le contenu du panier</option>

	</select></th>
		<th><select  name="produit_double" id="produit_double" onchange="update_url()">
		<?php
		for ($i= 0; $i < sizeof($date_jour); $i++) {
			echo '<option ';
			 if(intval($formulaire[0]->id_produit_double)== $i + 1){echo "selected ";} 
			echo 'value="'.$date_jour[$i]->sku.'">'.$date_jour[$i]->name."</option>";
			}
			?>
	</select></th>
	<th  id="url_double"><?php echo 'http://bytesclicker.online/interfaceMVC/?page=clic&clic=2&hash='.$formulaire[0]->hash; ?></th>
	</tr>
	 
	<tr>
		<th>Long</th>
		<th><select name="action_long" id="action_long" onchange="update_url()">
		<option value="2" <?php if($formulaire[0]->action_long== '2'){echo "selected";} ?> >Ajouter une unit&eacute; de</option>
		<option value="5"  <?php if($formulaire[0]->action_long== '5'){echo "selected";} ?> >Retirer une unit&eacute; de</option>
		<option value="1" <?php if($formulaire[0]->action_long== '1'){echo "selected";} ?> >Mettre &agrave; 1 la quantit&eacute; de</option>
		<option value="3" <?php if($formulaire[0]->action_long== '3'){echo "selected";} ?> >Supprimer le produit du panier</option>
		<option value="4"  <?php if($formulaire[0]->action_long== '4'){echo "selected";} ?> >Commander le contenu du panier</option>
	</select></th>
		<th><select  name="produit_long" id="produit_long" onchange="update_url()">
		<?php
		for ($i= 0; $i < sizeof($date_jour); $i++) {
			echo '<option ';
			 if(intval($formulaire[0]->id_produit_long)== $i + 1){echo "selected ";} 
			echo 'value="'.$date_jour[$i]->sku.'">'.$date_jour[$i]->name."</option>";
			}
			?>
	</select></th>
	<th id="url_long"> <?php echo 'http://bytesclicker.online/interfaceMVC/?page=clic&clic=3&hash='.$formulaire[0]->hash; ?> </th> 
	</tr>
	</tbody>		
	
</table><br>
	Recevoir des mails si le prix augmente ?<input type="checkbox" name="mailing" <?php if($formulaire[0]->notifications_mail== '1'){echo "checked";} ?>></input><br><br>
	<div class="mdl-card__actions mdl-card--border">
				<input type="submit" value="Mettre &agrave; jour" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect"></input>
	</div>
</form>
</div>
 