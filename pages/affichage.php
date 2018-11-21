<?php
	if (!empty($_POST['annee']) && !empty($_POST['semestre']) && !empty($_POST['filiere'])) {
		$annee = htmlspecialchars(trim($_POST['annee']));
		$semestre = htmlspecialchars(trim($_POST['semestre']));
		$filiere = htmlspecialchars(trim($_POST['filiere']));
	}
?>

	 <a href="javascript:printdiv('zone')"><img src="img/imprimer.jpg" alt="imprimer"></a>
		<div id="zone">
			<table class="centered striped bordered" >
				<thead>
					<?php 

					header_tableau(); ?>
				</thead>
				<tbody>
					<?php // body_tableau(); ?>
				</tbody>
				<tfoot>
					<?php //footer_tableau(); ?>
				</tfoot>
			</table>
		</div>
		