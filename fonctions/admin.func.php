<?php 


	function ajouter_admin($pseudo,$pass)
	{
		
		global $bd;
		$r = array(
			'pseudo' => $pseudo,
			'password' => $pass
		);
		$req = $bd->prepare("INSERT INTO admin(pseudo,password) VALUES(:pseudo,:password) ");
		$req->execute($r);
		
	}	

?>