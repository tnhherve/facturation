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
    	$sql="SELECT * FROM factureEau ";
    	$req=$bd->query($sql);
    	while ($data = $req->fetch()) {
    		echo "<option value='".$data['id_facture_eau']."'>".$data['periode']."</option>";
    	}
    	
    }

    function get_periode_id($id_facture){
    	global $bd;
    	$req = $bd->query("SELECT periode FROM factureEau WHERE id_facture_eau='".$id_facture."' ");
    	$data = $req->fetch();
    	return $data['periode'];
    }

	function verification0(){// verifie si la table consommationEau est vide ou pas
    	global $bd;

    	$rst = $bd->query("SELECT COUNT(*) as nbre FROM consommationEau ");
    	$data = $rst->fetch();
    	return $data['nbre'];
    }

      function verification1($periode,$annee){// verifie qu'on ajoute pas la meme periode deux fois pour la même année
    	global $bd;

    	$rst = $bd->query("SELECT COUNT(*) as nbre FROM consommationEau WHERE id_annee=".date('Y')." AND periode = '".$periode."' ");
    	$data = $rst->fetch();
    	return $data['nbre'];
    }

	function ajouter_consommation($id_consommateur,$id_facture,$periode,$montant){// ajoute le consommation d'un consommateur
		global $bd;
		test_ajout_annee();
		$t = array(
			'id_consommateur' => $id_consommateur ,
			'id_annee' => date('Y'),
			'id_facture_eau' => $id_facture,
			'periode' => $periode,
			'montant' => $montant
		 );
		$req = $bd->prepare("INSERT INTO consommationEau(id_consommateur,id_annee,id_facture,periode,montant)  VALUES(:id_consommateur,:id_annee,:id_facture,:periode,:montant)");
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
		$rst = $bd->query("SELECT date_limite  FROM factureEau WHERE id_facture_eau='".$id_facture."'");
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
    
	function get_montant_facture($id_facture){
		global $bd;
		$rst = $bd->query("SELECT montant_facture FROM factureEau WHERE id_facture_eau='".$id_facture."'");
		$data = $rst->fetch();
		return $data['montant_facture'];
	}




	
	
?>
