<?php


    function code_facture(){ // genere l'identifiant d'une facture
    	global $bd;
    	$sql = "SELECT COUNT(*) as nbre FROM factureEau ";
		$req = $bd->query("SELECT COUNT(*) as nbre FROM factureEau ");
		$data = $req->fetch();
		$nbre = $data['nbre'];
		if ($nbre == 0) {
			$nbre = $nbre + 1;
		 	$code = "FACTURE_EAU8_0".$nbre;
		 } else{
		 	$req = $bd->query("SELECT * FROM factureEau");
		 	while ($data = $req->fetch()) {
		 	 	$lastCode = $data['id_facture_eau'];
		 	 } 
		 	$n = substr($lastCode, -2);
		 	$n = $n +1; 
		 	if ($n <= 9) {
		 		$code = "FACTURE_EAU8_0".$n;
		 	}else{
		 		$code = "FACTURE_EAU8_".$n;
		 	}
		 }
		 return $code;
    }

    function verification0(){// verifie si la table facture est vide ou pas
    	global $bd;

    	$rst = $bd->query("SELECT COUNT(*) as nbre FROM factureEau ");
    	$data = $rst->fetch();
    	return $data['nbre'];
    }

      function verification1($periode,$annee){// verifie qu'on ajoute pas la meme periode deux fois pour la même année
    	global $bd;

    	$rst = $bd->query("SELECT COUNT(*) as nbre FROM factureEau WHERE annee=".$annee." AND periode='".$periode."' ");
    	$data = $rst->fetch();
    	return $data['nbre'];
    }

	function ajouter_facture($periode,$montant,$date_limite){
		global $bd;
		$id = code_facture();
		$r = array(
			'id_facture_eau' => $id ,
			'periode' => $periode,
			'montant_facture' => $montant,
			'date_limite' => $date_limite,
			'annee' => date('Y')
			 );
		$sql = "INSERT INTO factureEau VALUES(:id_facture,:periode,:montant_facture,:date_limite,:annee)";
		$req = $bd->prepare($sql);
		$req->execute($r);
	}

?>
