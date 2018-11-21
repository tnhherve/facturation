<?php
	if (isLogged()==0) {
		header("Location:index.php?page=signin");
	}
?>

<?php
	if (isset($_POST['update_conso'])) {
		$id = htmlspecialchars(trim($_POST['id']));
		$nom = htmlspecialchars(trim($_POST['nom']));
		$email =htmlspecialchars(trim($_POST['email']));
		$telephone = htmlspecialchars(trim($_POST['telephone']));
		$nbre = htmlspecialchars(trim($_POST['nbre']));
		$etat = htmlspecialchars(trim($_POST['etat']));
		update_conso($id,$nom,$telephone,$email,$nbre,$etat);
		//header("location:index.php?page=listeConso");
		?><script type="text/javascript">alert("Mise à jour éffectuer avec succès ");</script><?php

	}

	if (isset($_POST['update_index'])) {
		$id = htmlspecialchars(trim($_POST['id']));
		$ancien_index = htmlspecialchars(trim($_POST['ancien_index']));
		$nouvelle_index =htmlspecialchars(trim($_POST['nouvelle_index']));
		update_index($id,$ancien_index,$nouvelle_index);
		?><script type="text/javascript">alert("Mise à jour éffectuer avec succès ");</script><?php
		header("location:index.php?page=listeConso");
	}

	if (isset($_POST['delete_conso'])){
		$id = htmlspecialchars(trim($_POST['id']));
		delete_conso($id);
		?><script type="text/javascript">alert("Suppression éffectuer avec succès ");</script><?php
	}

?>

<h4>Liste des consommateurs</h4>
 
		<div id="zone">
			<table class="centered striped bordered" >
				<thead>
					<?php header_tableau(); ?>
				</thead>
				<tbody>
					<?php body_tableau(); ?>
				</tbody>
			</table>
		</div>

		<a href="javascript:printdiv('zone')"><img src="img/imprimer.jpg" alt="imprimer"></a>

		<?php
			modal();
			modal_index();
			modal_delete();
		?>	
		<!--  <div id="modal1" class="modal modal-fixed-footer">
		    	<form method="post">
		    		<div class="modal-content">
			    		<h4>Modifier Consommateur</h4>
			    		<div class="div input-field col s6">
							<i class="material-icons prefix"><span class="i-user"></span></i>
							<input type="text" id="nom" name="nom"  class="validate" required="">
							<label for="nom">Nom</label>
						</div>
						
						<div class="div input-field col s6">
							<i class="material-icons prefix"><span class="i-phone"></span></i>
							<input type="text" id="telephone" name="telephone" class="validate" required="">
							<label for="telephone">Telephone</label>
						</div>
						<div class="div input-field col s6">
							<i class="material-icons prefix"><span class="i-mail"></span></i>
							<input type="text" id="email" name="email" class="validate" required="">
							<label for="email">E-mail</label>
						</div>
						<div class="div input-field col s6">
							<i class="material-icons prefix"><span class="i-mail"></span></i>
							<input type="text" id="nbre" name="nbre" class="validate" required="">
							<label for="email">Nombre</label>
						</div>
			      
		    		</div>
				    <div class="modal-footer">
				      <button class="modal-action modal-close waves-effect waves-green btn-flat" name="submit">Modifier</button> 
				    </div>
				</form>    
		 </div> -->