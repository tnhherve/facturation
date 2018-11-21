
<?php
	if (isLogged()==0) {
		header('Location:index.php?page=signin');
	}
?>
<?php
	
	if (isset($_POST['submit'])) {
		if (verification0()==0) {
			if (!empty($_POST['periode'])) {
				$periode = htmlspecialchars($_POST['periode']);
				$montant = htmlspecialchars($_POST['montant']);
				$kwh = htmlspecialchars($_POST['kwh']);
				$date = htmlspecialchars(trim($_POST['date_limite']));
				ajouter_facture($periode,$montant,$kwh,$date);
				?><script type='text/javascript'>alert('Insertion reussie');</script><?php
			}else{
				?><script type='text/javascript'>alert('Veillez spécifiez la période !!!');</script><?php
			}
			
		} elseif (!empty($_POST['periode'])) {
			if (verification1(htmlspecialchars($_POST['periode']),date('Y'))==0) {
				$periode = htmlspecialchars($_POST['periode']);
				$montant = htmlspecialchars($_POST['montant']);
				$kwh = htmlspecialchars($_POST['kwh']);
				$date = htmlspecialchars(trim($_POST['date_limite']));
				ajouter_facture($periode,$montant,$kwh,$date);
				?><script type='text/javascript'>alert('Insertion reussie');</script><?php
			}else{
				?><script type='text/javascript'>alert('Période déja enregistrer pour cette année veillez la changer');</script><?php	
			}
		} else{
			?><script type='text/javascript'>alert('Veillez spécifiez la période !!!');</script><?php
			
		}
		
	}
?>


<form  method='POST' id='regForm'>
				<div class='col s12'>
					<h2>Ajouter une facture</h2>
					
					<div class='div input-field col s6'>
					    <i class='material-icons prefix'><span class='i-calendar'></span></i>
						<select name='periode'>
							<option value=' disabled selected='>Choisissez de la période</option>
							<option value='Janvier-Fevrier'>Janvier-Fevrier</option>
							<option value='Fevrier-Mars'>Fevrier-Mars</option>
							<option value='Mars-Avril'>Mars-Avrilr</option>
							<option value='Avril-Mai'>Avril-Mai</option>
							<option value='Mai-Juin'>Mai-Juin</option>
							<option value='Juin-Juillet'>Juin-Juillet</option>
							<option value='Juillet-Août'>Juillet-Août</option>
							<option value='Août-Septembre'>Août-Septembre</option>
							<option value='Septembre-Octobre'>Septembre-Octobre</option>
							<option value='Octobre-Novembre'>Octobre-Novembre</option>
							<option value='Novembre-Decembre'>Novembre-Decembre</option>
							<option value='Decembre-Janvier'>Decembre-Janvier</option>
						</select>
						<label for='periode'>Période</label>

					</div>
					
					<div class='div input-field col s12'>
						<i class='material-icons prefix'><span class='i-phone'></span></i>
						<input type='number' placeholder='1000.00' step='0.01' min='500' max='80 000' id='montant' name='montant' class='validate' required=''>
						<label for='montant'>Montant</label>
					</div>
					<div class='div input-field col s12'>
						<i class='material-icons prefix'><span class='i-mail'></span></i>
						<input type='number' placeholder='5.0' step='0.01' min='5.00' max='1000.00' id='kwh' name='kwh' class='validate' required=''>
						<label for='kwh'>Prix KWH</label>
					</div>
					
					<div class='div input-field col s12'>
						<i class='material-icons prefix'><span class='i-date'></span></i>
						<input type='date' id='date' name='date_limite' class='validate' required=''>
						<label for='date'></label>
					</div>
					
				</div>
				<br><br>
				<div class=' col s12'>
					<button type='submit' class='btn btn-block col s12 blue' name='submit'>Enregistrer</button>
				</div>
			</form>