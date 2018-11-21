<ul id="facture" class="dropdown-content">
	<li><a href="index.php?page=facture"><span class="i-plus large"></span> Ajouter Facture Eletricité</a></li>
	<li><a href="index.php?page=factureEau"><span class="i-plus large"></span> Ajouter Facture Eau</a></li>
	<li><a href="index.php?page=listeFacture"><span class="i-list large"></span> Liste des factures Electricité</a></li>
	<li><a href="index.php?page=listeFacture"><span class="i-list large"></span> Liste des factures Eau</a></li>
</ul>
<ul id="consommateur" class="dropdown-content">
	<li><a href="index.php?page=register"><span class="i-plus large"></span>Ajouter Consommateur</a></li>
	<li><a href="index.php?page=listeConso"><span class="i-list large"></span> Liste des Consommateur</a></li>
</ul>
<ul id="consommation" class="dropdown-content">
	<li><a href="index.php?page=consommation"><span class="i-plus large"></span>Ajouter Consommations Electricité</a></li>
	<li><a href="index.php?page=consommationEau"><span class="i-plus large"></span>Ajouter Consommations Eau</a></li>
	<li><a href="index.php?page=impression"><span class="i-list large"></span>Consommations en cours</a></li>
</ul>
<ul id="admin" class="dropdown-content">
	<li><a href="index.php?page=admin"><span class="i-plus large"></span>Ajouter Admin</a></li>
	<li><a href="#"><span class="i-list large"></span> Liste des Admin</a></li>
</ul>


	<nav class="grey darken-4" id="nav-content">

			<div class="nav-wrapper">
				<a href="index.php?page=home" class="brand-logo">DANKAFAC</a>
				<?php
					if (isLogged()==1) {
				
				?>
					<ul class="right hide-on-med-and-down" >
						<li><a class="dropdown-button" href="#!" data-activates="admin" href="#" ><span class="i-user large"></span>Administration</a></li>
						<li><a class="dropdown-button" href="#!" data-activates="facture" href="#" ><span class="i-folder-open large"></span> Factures</a></li>
						<li><a class="dropdown-button" href="#!" data-activates="consommateur" href="#" ><span class="i-user large"></span>Consommateurs</a></li>
						<li><a class="dropdown-button" href="#!" data-activates="consommation" href="#" ><span class="i-folder-open large"></span>Consommations</a></li>
						<li><a href="index.php?page=deconnexion" target="_blank"><span class="i-window-close large"></span> Deconnexion</a></li>
					</ul>
				<?php		

					}
				 ?>
				
			</div>
		
	</nav>