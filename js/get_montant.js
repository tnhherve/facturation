$(document).ready(function(){

	var $periode = $('#periode');
	$periode.on('change',function(){
		var val = $(this).val();
		if (val!='') {
			$.ajax({
				url: 'fonctions/res.php',
				data: 'id_facture='+val,
				dataType: 'json',
				success: function(data){

					    var html = '<input type="text" name="montant" value="'+data[0].montant_facture+'" id="montant" class="validate" readonly="">';
						$('#montant').html(html);
					
				}
			});
		}
	})
	

});