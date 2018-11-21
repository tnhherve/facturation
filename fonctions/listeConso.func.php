<?php

	function header_tableau(){
		
		echo "
			<tr>
			    <th>Nom</th>
			    <th>Téléphone</th>
			    <th>E-mail</th>
			    <th>Nombres par Chambre</th>
			    <th>Etat</th>
			    <th>Editer</th>
			    <th>Editer index </th>
			    <th>Delete</th>
			    <th></th>
			</tr>
			";	
	}

	function body_tableau(){
		global $bd;
		$rst = $bd->query("SELECT * FROM consommateur ORDER BY nbre asc");
		while ($data = $rst->fetch()) {
	    	echo "<tr>
				<td>".$data['nom_consommateur']."</td>
				<td>".$data['telephone_consommateur']."</td>
				<td>".$data['email_consommateur']."</td>
				<td>".$data['nbre']."</td>
				<td>".$data['etat']."</td>
				<td> <a class='modal-trigger' href='#modal1-".$data['id_consommateur']."'><span class='i-edit large'></span></a></td>
				<td> <a class='modal-trigger' href='#modal1-".$data['id_consommateur']."-index'><span class='i-edit large'></span></a></td>
				<td> <a class='modal-trigger' href='#modal1-".$data['id_consommateur']."-delete'><span class='i-window-close large'></span></a></td>
			</tr>";
		}
	}

	function modal(){
		global $bd;
		$rst = $bd->query("SELECT * FROM consommateur ORDER BY nbre asc ");
		while($data = $rst->fetch()){
			echo "<div id='modal1-".$data['id_consommateur']."' class='modal modal-fixed-footer'>
		    	<form method='post'>
		    	   <h4>Modifier Consommateur</h4>
		    		<div class='modal-content'>
						<div class='div input-field col s6'>
							<i class='material-icons prefix'><span class='i-user'></span></i>
							<input type='text' id='nom' name='nom' value='".$data['nom_consommateur']."'  class='validate' required>
							<label for='nom'>Nom</label>
						</div>
						
						<div class='div input-field col s6'>
							<i class='material-icons prefix'><span class='i-phone'></span></i>
							<input type='text' id='telephone' name='telephone' value='".$data['telephone_consommateur']."' class='validate' required>
							<label for='telephone'>Telephone</label>
						</div>
						<div class='div input-field col s6'>
							<i class='material-icons prefix'><span class='i-mail'></span></i>
							<input type='text' id='email' name='email' value='".$data['email_consommateur']."' class='validate' required>
							<label for='email'>E-mail</label>
						</div>
						<div class='div input-field col s6'>
							<i class='material-icons prefix'><span class='i-mail'></span></i>
							<input type='number' step='1' min='0' max='5' id='nbre' name='nbre' value='".$data['nbre']."' class='validate' required>
							<label for='nbre'>Nombre</label>
						</div>
						<div class='div input-field col s6'>
							<select name='etat'>
								<option value='disabled selected='>Choisissez l'etat</option>
								<option value='absent'>Absent</option>
								<option value='present'>Present</option>
							</select>	
							<label for='pass'>Etat</label>
						</div>
						<input type='hidden' id='nom' name='id' value='".$data['id_consommateur']."'  class='validate' required>
							
					</div>	
					<div class='modal-footer'>
				      <button class='modal-action modal-close waves-effect waves-green btn-flat' name='update_conso'>Modifier</button>
				      <button class='modal-action modal-close waves-effect waves-green btn-flat' type='reset'>Annuler</button> 
				    </div>
				</form>    
		 </div>	";
		}

	}

	function modal_index(){
		global $bd;
		$rst = $bd->query("SELECT c.id_consommateur, c.nom_consommateur, i.ancien_index, i.nouvelle_index, i.id_index FROM index_c as i, consommateur as c WHERE c.id_consommateur=i.id_consommateur ORDER BY c.id_consommateur asc ");
		while($data = $rst->fetch()){
			echo "<div id='modal1-".$data['id_consommateur']."-index' class='modal modal-fixed-footer'>
		    	<form method='post'>
		    	   <center><h4>Modifier Consommateur</h4></center>
		    		<div class='modal-content'>
						<div class='div input-field col s12'>
							<h3>".$data['nom_consommateur']."</h3>  
						</div>
						
						<div class='div input-field col s6'>
							<i class='material-icons prefix'><span class='i-user'></span></i>
							<input type='number' id='montant' name='ancien_index' value='".$data['ancien_index']."'placeholder='1.0' step='0.01' min='0' max='10000' class='validate'  required=''>
							<label for='montant'>Ancien Index</label>
						</div>
						<div class='div input-field col s6'>
							<i class='material-icons prefix'><span class='i-user'></span></i>
							<input type='number' id='montant' name='nouvelle_index' value='".$data['nouvelle_index']."'placeholder='1.0' step='0.01' min='0' max='10000' class='validate'  required=''>
							<label for='montant'>Ancien Index</label>
						</div>
						
						<input type='hidden' id='nom' name='id' value='".$data['id_index']."'  class='validate' required>
							
					</div>	
					<div class='modal-footer'>
				      <button class='modal-action modal-close waves-effect waves-green btn-flat' name='update_index'>Modifier</button>
				      <button class='modal-action modal-close waves-effect waves-green btn-flat' type='reset'>Annuler</button> 
				    </div>
				</form>    
		 </div>	";
		}

	}

	function modal_delete(){
		global $bd;
		$rst = $bd->query("SELECT * FROM consommateur ORDER BY nbre asc ");
		while($data = $rst->fetch()){
			echo "<div id='modal1-".$data['id_consommateur']."-delete' class='modal modal-fixed-footer'>
		    	<form method='post'>
		    	   
		    		<div class='modal-content'>
						<div class='col s12'>
							<h4>Voulez vous vraiment supprimer <h2>".$data['nom_consommateur']." ? </h2></h4>
						</div>
						
						<input type='hidden' id='nom' name='id' value='".$data['id_consommateur']."'  class='validate' required>
							
					</div>	
					<div class='modal-footer'>
				      <button class='modal-action modal-close waves-effect waves-green btn-flat' name='delete_conso'>Supprimer</button>
				      <button class='modal-action modal-close waves-effect waves-green btn-flat' type='reset'>Annuler</button> 
				    </div>
				</form>    
		 </div>	";
		}
	}

	function update_conso($id,$nom,$tel,$email,$nbre,$etat){
		global $bd;
		$t = array(
			'id_consommateur' =>$id,
			'nom_consommateur'=>$nom,
			'telephone_consommateur'=>$tel,
			'email_consommateur'=>$email,
			'nbre'=>$nbre, 
			'etat'=>$etat
		);
		$req = $bd->prepare("UPDATE consommateur SET nom_consommateur=:nom_consommateur, telephone_consommateur=:telephone_consommateur, email_consommateur=:email_consommateur, nbre=:nbre, etat=:etat WHERE id_consommateur=:id_consommateur ");
		$req->execute($t);
	}

	function update_index($id,$ancien_index,$nouvelle_index){
		global $bd;
		$t = array(
			'id_index' =>$id,
			'ancien_index'=>$ancien_index,
			'nouvelle_index'=>$nouvelle_index
		);
		$req = $bd->prepare("UPDATE index_c SET ancien_index=:ancien_index, nouvelle_index=:nouvelle_index WHERE id_index=:id_index ");
		$req->execute($t);
	}

	function delete_conso($id){
		global $bd;
		$bd->beginTransaction();
		try{
			
			$r = array('id_consommateur' => $id);
			$req_conso = $bd->prepare('DELETE FROM consommateur WHERE id_consommateur=:id_consommateur ');
			$req_conso->execute($r);
			$bd->commit();
			
		}catch(Exception $e){
			$bd->rollback() or die("erreur ".$e);
    	 	echo 'Tout ne s\'est pas bien passé, voir les erreurs ci-dessous<br />';
	    	echo 'Erreur : '.$e->getMessage().'<br />';
	    	echo 'N° : '.$e->getCode();
		}

	}

?>