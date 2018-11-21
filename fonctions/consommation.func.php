<?php

	function ajout_annee(){
		global $bd;
		$bd->exec("INSERT INTO annee VALUES('".date('Y')."')");
	}

    function test_ajout_annee(){
    	global $bd;
    	$req = $bd->query("SELECT COUNT(*) as nbre FROM annee");
    	$data = $req->fetch();
    	$nbre = $data['nbre'];
    	if ($nbre == 0) {
    		ajout_annee();
    	}else{
    		$req = $bd->query("SELECT id_annee FROM annee");
    		while($data = $req->fetch()){
    			if (date('Y')!=$data['id_annee']) {
    				ajout_annee();
    			}
    		}
    	}
    }

    function get_periode(){// retourne la periode de la facture
    	global $bd;
    	$sql="SELECT * FROM facture ";
    	$req=$bd->query($sql);
    	while ($data = $req->fetch()) {
    		echo "<option value='".$data['id_facture']."'>".$data['periode']."</option>";
    	}
    	
    }

    function get_periode_id($id_facture){
    	global $bd;
    	$req = $bd->query("SELECT periode FROM facture WHERE id_facture='".$id_facture."' ");
    	$data = $req->fetch();
    	return $data['periode'];
    }

    function get_prix_kwh($id_facture){
    	global $bd;
    	$req = $bd->query("SELECT prix_kwh FROM facture WHERE id_facture='".$id_facture."' ");
    	$data = $req->fetch();
    	return $data['prix_kwh'];
    }

	function get_consommateur(){
		global $bd;
		$sql = "SELECT id_consommateur,nom_consommateur FROM consommateur WHERE etat = 'present' ";
		$req = $bd->query($sql);
		while ($data = $req->fetch()) {
			echo '<div class="div input-field col s6">
						<i class="material-icons prefix"><span class="i-user"></span></i>
						<input type="number" id="montant" name="index'.$data['id_consommateur'].'" placeholder="1.0" step="0.01" min="0" max="10000" class="validate" required="">
						<label for="montant">'.$data['nom_consommateur'].'</label>
					</div>';
		}
		
	}

	function verification0(){// verifie si la table consomme est vide ou pas
    	global $bd;

    	$rst = $bd->query("SELECT COUNT(*) as nbre FROM consomme ");
    	$data = $rst->fetch();
    	return $data['nbre'];
    }

      function verification1($periode,$annee){// verifie qu'on ajoute pas la meme periode deux fois pour la même année
    	global $bd;

    	$rst = $bd->query("SELECT COUNT(*) as nbre FROM consomme WHERE id_annee=".date('Y')." AND periode = '".$periode."' ");
    	$data = $rst->fetch();
    	return $data['nbre'];
    }

	function ajouter_consommation($id_consommateur,$id_facture,$periode,$montant){// ajoute le consommation d'un consommateur
		global $bd;
		test_ajout_annee();
		$t = array(
			'id_consommateur' => $id_consommateur ,
			'id_annee' => date('Y'),
			'id_facture' => $id_facture,
			'periode' => $periode,
			'montant' => $montant
		 );
		$req = $bd->prepare("INSERT INTO consomme(id_consommateur,id_annee,id_facture,periode,montant)  VALUES(:id_consommateur,:id_annee,:id_facture,:periode,:montant)");
		$req->execute($t);
	}

	function getIdConsommateur(){ // retourne les identitfiants des consommateurs
		global $bd;
		$i=0;
		$tabIdCons = array();
		$req = $bd->query("SELECT id_consommateur FROM consommateur WHERE etat = 'present' ");
		while($data = $req->fetch()){
			$tabIdCons[$i++] = $data['id_consommateur'];
		}
		return $tabIdCons;
	}

	function compteConso(){ // cpte le nombre d'utilisateur sur qui vont s'appliquer les fuites (donc le nombre est égale a 1) 
		global $bd;
		$req = $bd->query("SELECT COUNT(*) as nbre FROM consommateur WHERE nbre <> 0 AND etat = 'present' ");
		$data = $req->fetch();
		return $data['nbre'];
	}

	function getDateLimite($id_facture){
		global $bd;
		$rst = $bd->query("SELECT date_limite  FROM facture WHERE id_facture='".$id_facture."'");
		$data = $rst->fetch();
		return $data['date_limite'];
	}

		function codeIndex(){//genere l'identifiant d'un index
		global $bd;
		$sql = "SELECT COUNT(*) as nbre FROM index_c ";
		$req = $bd->query($sql);
		$data = $req->fetch();
		$nbre = $data['nbre'];
		if ($nbre == 0) {
			$nbre = $nbre + 1;
		 	$code = "INDEX0".$nbre;
		 } else{
		 	$req = $bd->query("SELECT * FROM index_c");
		 	while ($data = $req->fetch()) {
		 	 	$lastCode = $data['id_index'];
		 	 } 
		 	$n = substr($lastCode, -2); 
		 	$n = $n +1;
		 	if ($n <= 9) {
		 		$code = "INDEX0".$n;
		 	}else{
		 		$code = "INDEX".$n;
		 	}
		 }
		 return $code;
		
	}
    
    function compteIndex(){// compte le nombre de tuple dans la table  index_c
    	global $bd;
    	$sql = "SELECT COUNT(*) as nbre FROM index_c";
    	$req = $bd->query($sql);
    	$data = $req->fetch();
    	return $data['nbre'];
    }

	function ajouteIndexIfEmpty($id_consommateur,$new_index,$diff){
		global $bd;
			$id_index = codeIndex();
			$r = array(
				'id_index' => $id_index,
				'id_consommateur' => $id_consommateur,
				'ancien_index' => 0,
				'nouvelle_index' => $new_index ,
				'difference_index' => $diff
			);
			$sql = "INSERT INTO index_c VALUES(:id_index,:id_consommateur,:ancien_index,:nouvelle_index,:difference_index) ";
			$req = $bd->prepare($sql);
			$req->execute($r);
	}

	function ajouteIndexIfNotEmpty($id_consommateur,$new_index,$diff){
		global $bd;
		$r = array(
			'id_consommateur' => $id_consommateur,
			'nouvelle_index' => $new_index,
			'difference_index' => $diff
		);
		$sql = "UPDATE index_c SET nouvelle_index = :nouvelle_index, difference_index = :difference_index WHERE id_consommateur = :id_consommateur ";
		$req = $bd->prepare($sql);
		$req->execute($r);
	}

	function permuteIndex($id_consommateur){ 
		/* permet lors de l'ajout des nouvelles index, de mettre a ancien index, la valeur qui etais autre fois la nouvelle index */
		global $bd;
		$req = $bd->query("SELECT nouvelle_index, ancien_index FROM index_c WHERE id_consommateur='".$id_consommateur."' ");
		$data = $req->fetch();
		$bd->exec("UPDATE index_c SET nouvelle_index = 0, ancien_index = '".$data['nouvelle_index']."', difference_index = 0 WHERE id_consommateur = '".$id_consommateur."' ");
	}

	function difference_index($id_consommateur,$new_index){
		global $bd;
		$rst = $bd->query("SELECT ancien_index FROM index_c WHERE id_consommateur='".$id_consommateur."' ");
		$data = $rst->fetch();
		$diff = $new_index - $data['ancien_index'];
		return $diff;
	}
	
	
?>
