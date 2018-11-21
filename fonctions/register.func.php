<?php 

	function code_conso(){
		global $bd;
		$sql = "SELECT COUNT(*) as nbre FROM consommateur ";
		$req = $bd->query("SELECT COUNT(*) as nbre FROM consommateur ");
		$data = $req->fetch();
		$nbre = $data['nbre'];
		if ($nbre == 0) {
			$nbre = $nbre + 1;
		 	$code = "CONSO0".$nbre;
		 } else{
		 	$req = $bd->query("SELECT * FROM consommateur");
		 	while ($data = $req->fetch()) {
		 	 	$lastCode = $data['id_consommateur'];
		 	 } 
		 	$n = substr($lastCode, -2); 
		 	$n = $n +1;
		 	if ($n <= 9) {
		 		$code = "CONSO0".$n;
		 	}else{
		 		$code = "CONSO".$n;
		 	}
		 }
		 return $code;
		
	}

	function email_taken($email)
	{
		global $bd;
		$e = array('email_consommateur'=>$email);
		$sql = "SELECT * FROM consommateur WHERE email_consommateur = :email_consommateur";
		$req = $bd->prepare($sql);
		$req->execute($e);
		$free = $req->rowCount($sql);
		return $free;
	}

	function ajouter_conso($nom,$telephone,$email,$nbre,$etat)
	{
		$id = code_conso();
		global $bd;
		$r = array(
			'id_consommateur' => $id,
			'nom_consommateur' => $nom,
			'telephone_consommateur' => $telephone,
			'email_consommateur' => $email,
			'nbre' => $nbre,
			'etat' => $etat
		);
		
		$req = $bd->prepare("INSERT INTO consommateur VALUES(:id_consommateur,:nom_consommateur,:telephone_consommateur,:email_consommateur,:nbre,:etat) ");
		$req->execute($r);
		
	}	

?>