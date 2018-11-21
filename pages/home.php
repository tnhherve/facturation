
<?php 
	if (isLogged()==0) {
		header("Location:index.php?page=signin");
	}

?>

<div class="parallax-container">
	<div class="parallax"><img src="img/cpu1.jpg" alt="cpu1" style="height: 10px;"></div>

</div>

		<div class="col s12">
			
			
		<?php

			if (isset($_POST['login_success'])) {
				$session->setFlash("vous avez bien été connecter","green");
				header("location:index.php?page=user");
			}
			if (isset($_POST['login_fail'])) {
				$session->setFlash("vous n'avez pas été connecter","red");
				header("location:index.php?page=user");
			}


		?>

	</div>
</div>