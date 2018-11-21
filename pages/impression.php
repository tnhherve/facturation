<?php
	if (isLogged()==0) {
		header("Location:index.php?page=signin");
	}

	if (isset($_SESSION['id_facture']) && !empty($_SESSION['id_facture'])) {
		$facture = $_SESSION['id_facture'];
	}else{
		$facture = getLastIdFacture();
	}	
?>

	 <a href="javascript:printdiv('zone')"><img src="img/imprimer.jpg" alt="imprimer"></a>
		<div id="zone">
			<table class="centered striped bordered" >
				<thead>
					<?php 

					header_tableau($facture); ?>
				</thead>
				<tbody>
					<?php body_tableau($facture); ?>
				</tbody>
				<tfoot>
					<?php footer_tableau($facture); ?>
				</tfoot>
			</table>
		</div>
		