<?php

	function header_tableau(){
		
		echo "
			<tr>
			    <th>Période</th>
			    <th>Montant</th>
			    <th>Prix KWH</th>
			    <th>Année</th>
			    <th></th>
			</tr>
			";	
	}

	function body_tableau(){
		global $bd;
		$rst = $bd->query("SELECT * FROM facture ORDER BY id_facture asc");
		while ($data = $rst->fetch()) {
	    	echo "<tr>
				<td>".$data['periode']."</td>
				<td>".$data['montant_facture']."</td>
				<td>".$data['prix_kwh']."</td>
				<td>".$data['annee']."</td>
				<td> <a class='waves-effect waves-light btn modal-trigger' href='#modal1-".$data['id_facture']."'><span class='i-edit large'></span>Modifier</a></td>
			</tr>";
		}
	}

	function modal(){
		global $bd;
		$rst = $bd->query("SELECT * FROM facture ORDER BY id_facture asc ");
		while($data = $rst->fetch()){
			echo "<div id='modal1-".$data['id_facture']."' class='modal modal-fixed-footer'>
		    	<form method='post'>
		    	   <h4>Modifier Facture</h4>
		    		<div class='modal-content'>
                    <div class='div input-field col s6'>
                        <i class='material-icons prefix'><span class='i-calendar'></span></i>
                        <select name='periode'>
                            <option value='".$data['periode']."'>".$data['periode']."</option>
                            <option value='Janvier-Fevrier'>Janvier-Fevrier</option>
                            <option value='Fevrier-Mars'>Fevrier-Mars</option>
                            <option value='Mars-Avril'>Mars-Avrilr</option>
                            <option value='Avril-Mai'>Avril-Mai</option>
                            <option value='Mai-Juin'>Mai-Juin</option>
                            <option value='Juin-Juillet'>Juin-Juillet</option>
                            <option value='Juillet-Août'>Juillet-Août</option>
                            <option value='Août-Septembre'>Août-Septembre</option>
                            <option value='Septembre-Octobre'>Septembre-Octobre</option>
                            <option value='Octobre-Novembre'>Octobre-Novembre</option>
                            <option value='Novembre-Decembre'>Novembre-Decembre</option>
                            <option value='Decembre-Janvier'>Decembre-Janvier</option>
                        </select>
                    </div>
						
						<div class='div input-field col s6'>
							<i class='material-icons prefix'><span class='i-phone'></span></i>
							<input type='text' id='montant' name='montant' value='".$data['montant_facture']."' class='validate' required>
							<label for='montant'>montant</label>
                        </div>
                        
                        <div class='div input-field col s12'>
                            <i class='material-icons prefix'><span class='i-mail'></span></i>
                            <input type='number' placeholder='5.0' step='0.01' min='5.00' max='1000.00' id='kwh' name='kwh' value='".$data['prix_kwh']."' class='validate' required=''>
                            <label for='kwh'>Prix KWH</label>
                        </div>

						<div class='div input-field col s6'>
							<i class='material-icons prefix'><span class='i-mail'></span></i>
							<input type='text' id='annee' name='annee' value='".$data['annee']."' class='validate' required>
							<label for='annee'>Année</label>
						</div>
						
						<input type='hidden' id='id' name='id' value='".$data['id_facture']."'  class='validate' required>
							
					</div>	
					<div class='modal-footer'>
				      <button class='modal-action modal-close waves-effect waves-green btn-flat' name='submit'>Modifier</button>
				      <button class='modal-action modal-close waves-effect waves-green btn-flat' type='reset'>Annuler</button> 
				    </div>
				</form>    
		 </div>	";
		}

	}

	function update_facture($id,$periode,$montant,$prix_kwh,$annee){
		global $bd;
		$t = array(
			'id_facture' =>$id,
			'periode'=>$periode,
            'montant_facture'=>$montant,
            'prix_kwh' => $prix_kwh,
			'annee'=>$annee
		);
		$req = $bd->prepare("UPDATE facture SET periode=:periode, montant_facture=:montant_facture,
        prix_kwh:=prix_kwh, annee=:annee WHERE id_facture=:id_facture ");
		$req->execute($t);
	}

?>