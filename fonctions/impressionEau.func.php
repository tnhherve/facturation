<?php
	
	function get_nbre_conso(){ // cpte le nombre d'utilisateur sur qui vont s'appliquer les fuites (donc le nombre est different de 0 et qui sont present) 
		global $bd;
		$req = $bd->query("SELECT SUM(nbre) as nbre FROM consommateur WHERE etat = 'present' ");
		$data = $req->fetch();
		return $data['nbre'];
	}

	function getDateLimite($id_facture){
		global $bd;
		$rst = $bd->query("SELECT date_limite  FROM factureEau WHERE id_facture_eau='".$id_facture."'");
		$data = $rst->fetch();
		return $data['date_limite'];
	}

	function somme($m,$a){
		$r = $m+$a+50;
		return $r;
	}

	function get_somme_montant($id_facture){
		global $bd;
		$rst = $bd->query("SELECT SUM(montant) as somme FROM consommationEau WHERE id_facture_eau = '".$id_facture."' ");
		$data = $rst->fetch();
		return $data['somme'];
	}
	function get_montant_facture($id_facture){
		global $bd;
		$rst = $bd->query("SELECT montant_facture FROM factureEau WHERE id_facture_eau = '".$id_facture."'");
		$data = $rst->fetch();
		return $data['montant_facture'];
	}

	function get_periode($id_facture){
		global $bd;
		$rst = $bd->query("SELECT periode FROM consommationEau WHERE id_facture_eau = '".$id_facture."' AND id_annee = '".date('Y')."' ");
		$data = $rst->fetch();
		return $data['periode'];	
	}


	function compte_all_conso(){ // cpte le nombre d'utilisateur sur qui vont s'appliquer les fuites (donc le nombre est égale a 1) 
		global $bd;
		$req = $bd->query("SELECT COUNT(*) as nbre FROM consommateur WHERE etat = 'present' AND nbre<>0 ");
		$data = $req->fetch();
		return $data['nbre'];
	}

	function getLastIdFacture(){
		global $bd;
		$rst = $bd->query("SELECT id_facture_eau FROM factureEau");
		while ($data = $rst->fetch()) {
			$last_id = $data['id_facture_eau'];
		}
		return $last_id;
	}

	
	
		function header_tableau($facture){
			
			echo "
				<tr>
				    <th colspan='2'>Gestion de Facturation</th>
				    <th colspan='8'>".get_periode($facture)."</th>
				    <th></th>
				    <th></th>
				    <th></th>
				    <th></th>
				    <th></th>
				   
				</tr>
				<tr>
				    <th>Consommateurs</th>
				    <th>Nombres</th>
				    <th>Montant</th>
				    <th>Frais Deplacement</th>
				    <th>Net à payer</th>
				</tr>
				";	

		}

		function body_tableau($facture){
			global $bd;
			$rst = $bd->query("SELECT DISTINCT c.etat, c.nom_consommateur, c.nbre, co.montant FROM consommateur as c, consommationEau as co, factureEau as f WHERE f.id_facture_eau=co.id_facture_eau AND f.id_facture_eau = '".$facture."' AND c.nbre<> 0 AND co.id_facture_eau='".$facture."' AND c.etat='present' ");
			while ($data = $rst->fetch()) {
				
				echo "<tr>
					<td>".$data['nom_consommateur']."</td>
					<td>".$data['nbre']."</td>
					<td><strong>".$data['montant']."<strong></td>
					<td>50</td>
					<td>".somme($data['montant'], 50)."</td>
				</tr>";
				
			}
			
			
		}

		function footer_tableau($facture){
			$total = get_montant_facture($facture) + compte_all_conso()*50;
			$somme_fuite = get_montant_facture($facture) - get_somme_montant($facture);
			echo "
				<tr>
				    <th >Total</th>
				    <th>".compte_all_conso()."</th>
				    <th>||||||||</th>
				    <th>||||||||</th>
				    <th>".get_somme_montant($facture)."</th
				    <th>".compte_all_conso()*50."</th>
				    <th>".$total."</th>
				</tr>
				<tr>
				    <th>Montant sur Facture</th><th ></th><th  ></th><th ></th><th>".get_montant_facture($facture)."</th><th ></th><th></th><th></th><th></th><th></th>
				</tr>
				<tr>
				   <mark> DATE LIMITE DE PAYEMENT : ".getDateLimite($facture)."!!!</mark>
				</tr>
				
				";	
		}
	

?>