<?php

	
	class Session 
	{
		
		function __construct()
		{
			session_start();
		}
		public function setFlash($message,$color="white")
		{
			$_SESSION['flash'] = [
				"color" => $color,
				"message" => $message

			];
		}
		public function showFlash()
		{
			if (!empty($_SESSION['flash'])) {
				$color = $_SESSION['flash']['color'];
				?>
				<script type="text/javascript">
					Materialize.toast("<i class='material-icons left<?php echo $color; ?>'><span class='i-eye'></span></i>"+"<?php echo $_SESSION['flash']['message'] ?>", 5000);
				</script>
				<?php

			}
		}
	}

?>