$(document).ready(function(){
	var company = getURLParameter('cid');
	var schwerpunkte =getURLParameter('schwerpunkte');
	var themen =getURLParameter('themen');
	var plz = getURLParameter('plz');
	
	$.ajax({
		type: 'GET',
		url: 'firm_data.php?cid='+company,
		dataType: "html", 
		success: function(data){
				$('.result').append(data);
		}
	});
	
	$('.result').delegate('#bewerten','click', function(){
		$('.wertung-form').fadeToggle();
	})
	/***** Bewertungen *****/
		.delegate('#stars li', 'hover',function(){
			var myClass =$(this).attr('class');
			$('#stars').css("background-image", "url(./img/Sterne/"+myClass+".png)");
		})

		.delegate('#stars li','click', function(){
			$('#stars li').each(function(){
				$(this).removeClass('active');
			});
			$(this).addClass('active');
			$('#stars').addClass('clicked');
		})

		.delegate('#stars', 'mouseout', function(){
			if(!$(this).hasClass('clicked')){
				$('#stars').css("background-image", "url(./img/Sterne/0sterne.png)");	
			}
		})


		.delegate('#wertung-senden', 'click',function(){
			var wertung, wText, fid;
			wertung=-1;
			wText ="";
			fid = -1;
			/*TODO fehlermeldung*/
			fid = $('#fid').html();
			wertung = $('#stars li.active').data('wert');
			wText = $('textarea[name="begruendung"]').val();
			if(wertung!=undefined && wText.length>0){
				$.ajax({
					type: 'POST',
					data:{cid: fid, wert: wertung, begruendung:wText },
					url: 'firm_data.php',
					dataType: "html", 
					success: function(data){
							$('.result').empty();
							$('.result').append(data);
					}
				});
			}

		});

	
});