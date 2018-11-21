<?php

	function users_exist($pseudo,$pass)
	{
		global $bd;
		$r = array(
			'pseudo' => $pseudo,
			'password' => $pass
		);
		$sql = "SELECT * FROM admin WHERE pseudo=:pseudo AND password=:password";
		$req = $bd->prepare($sql);
		$req->execute($r);
		$exist = $req->rowCount($sql);
		return $exist;
	} 

?>