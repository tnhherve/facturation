
<?php
	include("fonctions/connexion.php");

	$pages = scandir("pages/");
	if (isset($_GET['page']) && !empty($_GET['page'])) {
		if (in_array($_GET['page'].".php", $pages)) {
			$page = $_GET['page'];
		}else{
			$page = "signin";
		}
	}else{
		$page = "signin";
	}

	$page_func = scandir("fonctions/");
	if (in_array($page.".func.php", $page_func)) {
		include "fonctions/".$page.".func.php";
	}

	
?>

	<!DOCTYPE php>
	<html>
		<head>
			<link rel="stylesheet" type="text/css" href="css/materialize.css">
			<link rel="stylesheet" type="text/css" href="css/tuto.css">
			<meta charset="utf-8" name="viewport" content="width-device-width, initial-scale=1.0">
			<title>DANKALY CITY</title>
			<script type="text/javascript" src="js/jquery.js"></script>
			<script type="text/javascript" src="js/materialize.js"></script>
			<script type="text/javascript" src="js/materialize.min.js"></script>
			<script type="text/javascript" src="js/script.js"></script>
			<script type="text/javascript" src="js/get_montant.js"></script>
			<script type="text/javascript" src="js/jspdf.min.js"></script>
			
			<script type="text/javascript">
				// function genPDF() {
				// 	var doc = new jsPDF();
				// 	doc.fromHTML($('#zone').get(0),15,15, {'width': 300});
					
				// 	doc.save('facture.pdf');
				// }
				function printdiv(zone){
					var headstr = "<html><head><title></title></head></html><body>";
					var footerstr = "</body>";
					var newstr = document.all.item(zone).innerHTML;
					var allstr = document.body.innerHTML;
					document.body.innerHTML = headstr+newstr+footerstr;
					window.print();
					document.body.innerHTML = oldstr;
					return false;
				}
			</script>
			
		</head>
				<?php
				    include 'pages/topbar.php';
				?>
		<body>	
			

				<div class="container">
					<div class="row">
						<?php 
							require 'pages/'.$page.'.php';
							
						 ?>
					</div>
			    </div>	
				<!-- <?php
					//$page_js = scandir("js/");
					//if (in_array($page.".func.js", $page_js)) {
			    ?>
			    	<script type="text/javascript" src="js/<?php // echo $page ?>.func.js"></script>
			    <?php
					//}
				?> -->
				
		</body>
	</html>