<?php
	if (isLogged()==0) {
		header("Location:index.php?page=signin");
	}
?>
<?php
	
	if (isset($_POST['submit'])) {
		if(!empty($_POST['montant'])){
			$montant_facture = $_POST['montant'];
			$id_facture = $_POST['periode'];
			$periode = get_periode_id($id_facture);
			$prix_kwh = get_prix_kwh($id_facture); 
			$somme = 0;
			$data = getIdConsommateur();
			if (verification0()==0) {
				if (compteIndex()!=0) {
					foreach ($data as $id_con) {
						permuteIndex($id_con);			
					}
				}
				
				if (compteIndex() == 0) {
					foreach ($data as $id_con) {
						$difference_index = difference_index($id_con, $_POST['index'.$id_con]);
						$montant_conso = $difference_index*$prix_kwh;
						//$somme = $somme + $montant_conso;
						ajouteIndexIfEmpty($id_con,$_POST['index'.$id_con],$difference_index);
						ajouter_consommation($id_con,$id_facture,$periode,$montant_conso);	
					}
				}else{
					foreach ($data as $id_con) {
						$difference_index = difference_index($id_con, $_POST['index'.$id_con]);
						$montant_conso = $difference_index*$prix_kwh;
						//$somme = $somme + $montant_conso;
						ajouteIndexIfNotEmpty($id_con,$_POST['index'.$id_con],$difference_index);
						ajouter_consommation($id_con,$id_facture,$periode,$montant_conso);	
					}
				}
				
				$_SESSION['id_facture'] = $id_facture;
				header("location:index.php?page=impression");
			}elseif (verification1($periode,date('Y'))==0) {
				if (compteIndex()!=0) {
					foreach ($data as $id_con) {
						permuteIndex($id_con);			
					}
				}
				
				if (compteIndex() == 0) {
					foreach ($data as $id_con) {
						$difference_index = difference_index($id_con, $_POST['index'.$id_con]);
						$montant_conso = $difference_index*$prix_kwh;
						//$somme = $somme + $montant_conso;
						ajouteIndexIfEmpty($id_con,$_POST['index'.$id_con],$difference_index);
						ajouter_consommation($id_con,$id_facture,$periode,$montant_conso);	
					}
				}else{
					foreach ($data as $id_con) {
						$difference_index = difference_index($id_con, $_POST['index'.$id_con]);
						$montant_conso = $difference_index*$prix_kwh;
						//$somme = $somme + $montant_conso;
						ajouteIndexIfNotEmpty($id_con,$_POST['index'.$id_con],$difference_index);
						ajouter_consommation($id_con,$id_facture,$periode,$montant_conso);	
					}
				}
				
				$_SESSION['id_facture'] = $id_facture;
				header("location:index.php?page=impression");
		}else{
			?><script type="text/javascript">alert("Veuillez entre la période de la facture!!");</script><?php
		}
		
		}else{
			?><script type="text/javascript">alert("Période déja enregistrer pour cette année veillez la changer");</script><?php
		}
			
		
	}
		
?>


<form  method="POST" id="regForm">
				<div class="col s12">
					<h2>Ajouter une Consommation</h2>
					
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
					<?php get_consommateur(); ?>
					
					
				</div>
				<br><br>
				<div class=" col s12">
					<button type="submit" class="btn btn-block col s12 blue" name="submit">Enregistrer</button>
				</div>
			</form>