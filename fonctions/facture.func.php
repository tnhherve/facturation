<?php


    function code_facture(){ // genere l'identifiant d'une facture
    	global $bd;
    	$sql = "SELECT COUNT(*) as nbre FROM facture ";
		$req = $bd->query("SELECT COUNT(*) as nbre FROM facture ");
		$data = $req->fetch();
		$nbre = $data['nbre'];
		if ($nbre == 0) {
			$nbre = $nbre + 1;
		 	$code = "FACTURE0".$nbre;
		 } else{
		 	$req = $bd->query("SELECT * FROM facture");
		 	while ($data = $req->fetch()) {
		 	 	$lastCode = $data['id_facture'];
		 	 } 
		 	$n = substr($lastCode, -2);
		 	$n = $n +1; 
		 	if ($n <= 9) {
		 		$code = "FACTURE0".$n;
		 	}else{
		 		$code = "FACTURE".$n;
		 	}
		 }
		 return $code;
    }

    function verification0(){// verifie si la table facture est vide ou pas
    	global $bd;

    	$rst = $bd->query("SELECT COUNT(*) as nbre FROM facture ");
    	$data = $rst->fetch();
    	return $data['nbre'];
    }

      function verification1($periode,$annee){// verifie qu'on ajoute pas la meme periode deux fois pour la même année
    	global $bd;

    	$rst = $bd->query("SELECT COUNT(*) as nbre FROM facture WHERE annee=".$annee." AND periode='".$periode."' ");
    	$data = $rst->fetch();
    	return $data['nbre'];
    }

	function ajouter_facture($periode,$montant,$prix_kwh,$date_limite){
		global $bd;
		$id = code_facture();
		$r = array(
			'id_facture' => $id ,
			'periode' => $periode,
			'montant_facture' => $montant,
			'prix_kwh' => $prix_kwh,
			'date_limite' => $date_limite,
			'annee' => date('Y')
			 );
		$sql = "INSERT INTO facture VALUES(:id_facture,:periode,:montant_facture,:prix_kwh,:date_limite,:annee)";
		$req = $bd->prepare($sql);
		$req->execute($r);
	}

?>
