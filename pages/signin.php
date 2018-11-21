
<?php 

if (isset($_POST['login_success'])) {
	$pseudo = htmlspecialchars(trim($_POST['pseudo']));
	$pass = sha1(htmlspecialchars(trim($_POST['password'])));
	if (users_exist($pseudo,$pass)==1) {
			$_SESSION['pseudo']=$pseudo;
			header("Location:index.php?page=home");
		}else{
	?><script type="text/javascript">alert("Pseudo ou Password incorrecte");</script><?php 
		}
}

?>



		<div class="col s12">
			<div class="card login-wrapper">
			<h3>Se connecter</h3>
				<div class="card-content">
				<form method="POST">
					<div class="div input-field col s6">
						<i class="material-icons prefix"><span class="i-user"></span></i>
						<input type="text" id="pseudo" name="pseudo" class="validate">
						<label for="pseudo">Adresse</label>
					</div>
					<div class="div input-field col s6">
						<i class="material-icons prefix"><span class="i-lock"></span></i>
						<input type="password" id="pass" name="password" class="validate">
						<label for="pass">Mot de passe</label>
					</div>
					<div class=" col s6">
						<button type="submit" class="btn btn-block col s12 green" name="login_success">Connexion</button>
					</div>
					<div class="col s6">
						<button type="reset" class="btn btn-block col s12 red" name="login_fail">Annuler</button>
					</div>
					<br><br>
				</form>
			</div>	
		</div>
		</div>
			
		<?php

			// if (isset($_POST['login_success'])) {
			// 	$session->setFlash("vous avez bien été connecter","green");
			// 	header("location:index.php?page=user");
			// }
			// if (isset($_POST['login_fail'])) {
			// 	$session->setFlash("vous n'avez pas été connecter","red");
			// 	header("location:index.php?page=user");
			// }


		?>

		
			
			
		
	</div>
</div>