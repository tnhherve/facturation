<?php
	if (isLogged()==0) {
		header("Location:index.php?page=signin");
	}
?>

<?php
	if (isset($_POST['submit'])) {
		$id = htmlspecialchars(trim($_POST['id']));
		$periode = htmlspecialchars(trim($_POST['periode']));
        $montant =htmlspecialchars(trim($_POST['montant']));
        $prix_kwh = htmlspecialchars(trim($_POST['kwh']));
		$annee = htmlspecialchars(trim($_POST['annee']));
		update_conso($id,$periode,$montant,$prix_kwh,$annee);
		?><script type="text/javascript">alert("Mise à jour éffectuer avec succès ");</script><?php
	}
?>

<h4>Liste des Factures</h4>
 
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
		?>	
		<!--  <div id="modal1" class="modal modal-fixed-footer">
		    	<form method="post">
		    		<div class="modal-content">
			    		<h4>Modifier Consommateur</h4>
			    		<div class="div input-field col s6">
							<i class="material-icons prefix"><span class="i-user"></span></i>
							<input type="text" id="periode" name="periode"  class="validate" required="">
							<label for="periode">periode</label>
						</div>
						
						<div class="div input-field col s6">
							<i class="material-icons prefix"><span class="i-phone"></span></i>
							<input type="text" id="annee" name="annee" class="validate" required="">
							<label for="annee">annee</label>
						</div>
						<div class="div input-field col s6">
							<i class="material-icons prefix"><span class="i-mail"></span></i>
							<input type="text" id="montant" name="montant" class="validate" required="">
							<label for="montant">E-mail</label>
						</div>
						<div class="div input-field col s6">
							<i class="material-icons prefix"><span class="i-mail"></span></i>
							<input type="text" id="nbre" name="nbre" class="validate" required="">
							<label for="montant">periodebre</label>
						</div>
			      
		    		</div>
				    <div class="modal-footer">
				      <button class="modal-action modal-close waves-effect waves-green btn-flat" name="submit">Modifier</button> 
				    </div>
				</form>    
		 </div> -->