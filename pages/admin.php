<?php
	if (isLogged()==0) {
		header("Location:index.php?page=signin");
	}
?>
<?php

	if (isset($_POST['submit']) ) {
		$nom = htmlentities(trim($_POST['nom']));
		$pass = htmlspecialchars(trim(sha1($_POST['pass'])));
			ajouter_admin($nom,$pass);
			?><script type="text/javascript"> alert("Insertion reussie"); </script><?php	
		}
		
	
	
?>
	
			<form  method="POST" id="regForm">
				<div class="col s12">
					<h2 class="header header-form">Ajouter un Administrateur</h2>
					
					<div class="div input-field col s6">
						<i class="material-icons prefix"><span class="i-user"></span></i>
						<input type="text" id="nom" name="nom"  class="validate" required="">
						<label for="nom">Pseudo</label>
					</div>
					
					<div class="div input-field col s6">
						<i class="material-icons prefix"><span class="i-lock"></span></i>
						<input type="password" id="pass"  name="pass" class="validate" required="">
						<label for="pass">Mot de passe</label>
					</div>
					
				</div>
				<br><br>
				<div class=" col s12">
					<button type="submit" class="btn btn-block col s12 blue" name="submit">Ajouter</button>
				</div>
			</form>
	
		
			
