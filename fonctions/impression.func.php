<?php
	// function get_nbre($id_consommateur){
	// 	//retourne le nombre de personne par chambre d'un consommateur
	// 	global $bd;
	// 	$rst = $bd->query("SELECT nbre FROM consommateur WHERE id_consommateur = '".$id_consommateur."' ");
	// 	$data = $rst->fetch();
	// 	return $data['nbre'];

	// }
	function get_nbre_conso(){ // cpte le nombre d'utilisateur sur qui vont s'appliquer les fuites (donc le nombre est different de 0 et qui sont present) 
		global $bd;
		$req = $bd->query("SELECT SUM(nbre) as nbre FROM consommateur WHERE etat = 'present' ");
		$data = $req->fetch();
		return $data['nbre'];
	}

	function getDateLimite($id_facture){
		global $bd;
		$rst = $bd->query("SELECT date_limite  FROM facture WHERE id_facture='".$id_facture."'");
		$data = $rst->fetch();
		return $data['date_limite'];
	}

	function somme($m,$a){
		$r = $m+$a+50;
		return $r;
	}

	function get_somme_montant($id_facture){
		global $bd;
		$rst = $bd->query("SELECT SUM(montant) as somme FROM consomme WHERE id_facture = '".$id_facture."' ");
		$data = $rst->fetch();
		return $data['somme'];
	}
	function get_montant_facture($id_facture){
		global $bd;
		$rst = $bd->query("SELECT montant_facture FROM facture WHERE id_facture = '".$id_facture."'");
		$data = $rst->fetch();
		return $data['montant_facture'];
	}

	function get_fuite0($id_facture){
		global $bd;
		$rst = $bd->query("SELECT SUM(montant) as somme FROM consomme as c, consommateur as co WHERE co.nbre = 0 AND co.id_consommateur=c.id_consommateur AND co.etat='present' AND c.id_facture='".$id_facture."' ");
		$data = $rst->fetch();
		$f = $data['somme']*0.1;
		return $f;
	}

	function get_periode($id_facture){
		global $bd;
		$rst = $bd->query("SELECT periode FROM consomme WHERE id_facture = '".$id_facture."' AND id_annee = '".date('Y')."' ");
		$data = $rst->fetch();
		return $data['periode'];	
	}


	function compte_all_conso(){ // cpte le nombre d'utilisateur sur qui vont s'appliquer les fuites (donc le nombre est égale a 1) 
		global $bd;
		$req = $bd->query("SELECT COUNT(*) as nbre FROM consommateur WHERE etat = 'present' ");
		$data = $req->fetch();
		return $data['nbre'];
	}


	function get_fuite1($facture){
		$f = (get_montant_facture($facture) - get_somme_montant($facture) - get_fuite0($facture) )/get_nbre_conso();
		return $f;
	}

	function getLastIdFacture(){
		global $bd;
		$rst = $bd->query("SELECT id_facture FROM facture");
		while ($data = $rst->fetch()) {
			$last_id = $data['id_facture'];
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
				    <th></th>
				    <th></th>
				    <th></th>
				</tr>
				<tr>
				    <th>Consommateurs</th>
				    <th>Nombres</th>
				    <th>Index 1</th>
				    <th>Index 2</th>
				    <th>Index2 - Index1</th>
				    <th>Prix Kwh</th>
				    <th>Prix hors fuites</th>
				    <th>Consommations divers (Fuites)</th>
				    <th>Frais Deplacement</th>
				    <th>Net à payer</th>
				</tr>
				";	

		}

		function body_tableau($facture){
			global $bd;
			$rst = $bd->query("SELECT DISTINCT c.etat, c.nom_consommateur, c.nbre, i.nouvelle_index, i.ancien_index, i.difference_index, f.prix_kwh, co.montant FROM consommateur as c, consomme as co, facture as f, index_c as i WHERE i.id_consommateur=c.id_consommateur AND f.id_facture=co.id_facture AND i.id_consommateur=co.id_consommateur AND f.id_facture = '".$facture."' AND c.nbre<> 0 AND co.id_facture='".$facture."' AND c.etat='present' ");
			while ($data = $rst->fetch()) {
				
				echo "<tr>
					<td>".$data['nom_consommateur']."</td>
					<td>".$data['nbre']."</td>
					<td>".$data['ancien_index']."</td>
					<td>".$data['nouvelle_index']."</td>
					<td>".$data['difference_index']."</td>
					<td>".$data['prix_kwh']."</td>
					<td><strong>".$data['montant']."<strong></td>
					<td>".round(get_fuite1($facture)*$data['nbre'], 2)."</td>
					<td>50</td>
					<td>".somme($data['montant'], round(get_fuite1($facture)*$data['nbre'], 2))."</td>
				</tr>";
				
			}
			
			$rst = $bd->query("SELECT DISTINCT c.etat, c.nom_consommateur, c.nbre, i.nouvelle_index, i.ancien_index, i.difference_index, f.prix_kwh, co.montant FROM consommateur as c, consomme as co, facture as f, index_c as i WHERE i.id_consommateur=c.id_consommateur AND f.id_facture=co.id_facture AND i.id_consommateur=co.id_consommateur AND f.id_facture = '".$facture."' AND c.nbre=0 AND co.id_facture='".$facture."' AND c.etat='present' ");
			while ($data = $rst->fetch()) {
				echo "<tr>
					<td>".$data['nom_consommateur']."</td>
					<td>".$data['nbre']."</td>
					<td>".$data['ancien_index']."</td>
					<td>".$data['nouvelle_index']."</td>
					<td>".$data['difference_index']."</td>
					<td>".$data['prix_kwh']."</td>
					<td><strong>".$data['montant']."<strong></td>
					<td>".round($data['montant']*0.1, 2)."</td>
					<td>50</td>
					<td>".somme($data['montant'], round($data['montant']*0.1, 2))."</td>
				</tr>";
			}
		}

		function footer_tableau($facture){
			$total = get_montant_facture($facture) + 600;
			$somme_fuite = get_montant_facture($facture) - get_somme_montant($facture);
			echo "
				<tr>
				    <th >Total</th>
				    <th>".compte_all_conso()."</th>
				    <th>||||||||</th>
				    <th>||||||||</th>
				    <th>||||||||</th>
				    <th>||||||||</th>
				    <th>".get_somme_montant($facture)."</th>
				    <th>".$somme_fuite."</th>
				    <th>600</th>
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