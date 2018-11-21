<?php
	if (isLogged()==0) {
		header("Location:index.php?page=signin");
	}
?>
<?php

	if (isset($_POST['submit']) ) {
		$nom = htmlentities(trim($_POST['nom']));
		$telephone = htmlspecialchars(trim($_POST['telephone']));
		$email = htmlspecialchars(trim($_POST['email']));
		$etat = htmlspecialchars(trim($_POST['etat']));
		$nbre = htmlspecialchars(trim($_POST['nbre']));
		
		if (email_taken($email)!=0) {
			?><script type="text/javascript"> alert("Cette E-mail est déja utilisée"); </script><?php
		}else{
			echo $etat;
			ajouter_conso($nom,$telephone,$email,$nbre,$etat);
			?><script type="text/javascript"> alert("Insertion reussie"); </script><?php	
		}
		
	}
	
?>
	
			<form  method="POST" id="regForm">
				<div class="col s12">
					<h2 class="header header-form">Inscription</h2>
					
					<div class="div input-field col s6">
						<i class="material-icons prefix"><span class="i-user"></span></i>
						<input type="text" id="nom" name="nom"  class="validate" required="">
						<label for="nom">Nom</label>
					</div>
					
					<div class="div input-field col s6">
						<i class="material-icons prefix"><span class="i-phone"></span></i>
						<input type="text" id="telephone" name="telephone" class="validate" required="">
						<label for="telephone">Telephone</label>
					</div>
					<div class="div input-field col s6">
						<i class="material-icons prefix"><span class="i-mail"></span></i>
						<input type="text" id="email" name="email" class="validate" required="">
						<label for="email">E-mail</label>
					</div>
					<div class='div input-field col s6'>
							<i class='material-icons prefix'><span class='i-mail'></span></i>
							<input type='number' step='1' min='1' max='5' id='nbre' name='nbre' value='".$data['nbre']."' class='validate' required>
							<label for='nbre'>Nombre</label>
					</div>
					<div class="div input-field col s6">
						<i class="material-icons prefix"><span class="i-calendar"></span></i>
						<select name="etat">
							<option value="" disabled selected="">Choisissez l'etat</option>
							<option value="absent">Absent</option>
							<option value="present">Present</option>
						</select>	
						<label for="pass">Etat</label>
					</div>
					
				</div>
				<br><br>
				<div class=" col s12">
					<button type="submit" class="btn btn-block col s12 blue" name="submit">S'inscrire</button>
				</div>
			</form>
	
		
			
