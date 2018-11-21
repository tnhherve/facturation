<?php
	include 'connexion.php';
	if (isset($_GET['id_facture']) && !empty($_GET['id_facture'])) {
		$id_f = $_GET['id_facture'];
		$rst = $bd->query("SELECT montant_facture FROM facture WHERE id_facture = '".$id_f."' ");
		$data = $rst->fetchAll(PDO::FETCH_ASSOC) or die(print_r($bdd->errorInfo()));;
		echo json_encode($data);
	}

?>