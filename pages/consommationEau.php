<?php
	if (isLogged()==0) {
		header("Location:index.php?page=signin");
	}
?>
<?php
	
	if (isset($_POST['submit'])) {
		$id_facture = htmlspecialchars(trim($_POST['periode']));
		$montant_bayeur = htmlspecialchars(trim($_POST['montant_bayeur']));
		$montant_deplacement=htmlspecialchars(trim($_POST['montant_deplacement']));
		$data_id = getIdConsommateur();
		$periode = get_periode_id($id_facture);
		$nbre = str_len($data_id);
		if (verification0()!=0 || verification1($periode,date('Y'))==0) {
			$montant = round(get_montant($id_facture)/$nbre, 2);
			foreach ($data_id as $id_conso) {
				ajouter_consommation($id_conso,$id_facture,$periode,$montant);
			}
				
		}else{
			?><script type="text/javascript">alert("Période déja enregistrer pour cette année veillez la changer");</script><?php
		}
			
		$_SESSION['id_facture_eau'] = $id_facture;
		header("location:index.php?page=impressionEau");
	}
		
?>


<form  method="POST" id="regForm">
				<div class="col s12">
					<h2>Ajouter une Consommation d'Eau</h2>
					
					<div class="div input-field col s6">
					    <i class="material-icons prefix"><span class="i-calendar"></span></i>
						<select name="periode" id="periode">
							<option value="" disabled selected="">Choisissez de la période</option>
							<?php get_periode(); ?>
						</select>
						<label for="periode">Période</label>

					</div>
					<div class="div input-field col s6" id="montant">
					    <i class="material-icons prefix"><span class="i-calendar"></span></i>
					    
					    
					</div>    
					<div class="div input-field col s12">
						<i class="material-icons prefix"><span class="i-calendar"></span></i>
						<input type='number' placeholder='1000.00' step='0.01' min='500' max='80 000' id='montant' name='montant_bayeur' class='validate' required=''>
						<label for='montant'>Montant du bayeur</label>
					</div>
					<div class="div input-field col s12">
						<i class="material-icons prefix"><span class="i-calendar"></span></i>
						<input type='number' placeholder='1000.00' step='0.01' min='500' max='80 000' id='montant' name='montant_deplacement' class='validate' required=''>
						<label for='montant'>Montant du déplacement</label>
					</div>
					
					
				</div>
				<br><br>
				<div class=" col s12">
					<button type="submit" class="btn btn-block col s12 blue" name="submit">Enregistrer</button>
				</div>
			</form>