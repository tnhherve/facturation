<?php
 session_start();
	try {
		$bd = new PDO("mysql:host=localhost; dbname=facturation1","root","", array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8', PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
	} catch (Exception $e) {
		die("erreur de connexion ".$e->getMessage());
	}
	function isLogged()
	{
		if (isset($_SESSION['pseudo']) ) {
			$logged = 1;
		}else{
			$logged = 0;
		}
		return $logged;
	}

?>