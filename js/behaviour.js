$(document).ready(function(){
	$('#schwerpunkt').show();
	$('#tabs li a').click(function(event){
		event.preventDefault();
		var link =$(this).attr('href');	
		$('.auswahl:visible').hide();
		$(link).show();
	});



$('#firmen').click(function(event){
	var filter=getFilter();
	event.preventDefault();
	$.get('xml_result.php?mode=short&'+filter, function(data){
		console.log(data);
			var html='';

	$('#firmen_tab').append("<thead><tr>\n<th>Name</th>\n<th>PLZ</th>\n<th>Schwerpunkte</th>\n<th>Themen</th>\n<th>Bewertung</th>\n</tr></thead>");

		$(data).find('Firma').each(function(){
		console.log("in print companies");
				var $company = $(this);
				html ='<tr>';
				html += '<td><a href="./company.php?fid='.$company.find('FID').'"'+$company.find('Name').text()+'</td>';
				html += '<td>'+$company.find('PLZ').text()+'</td>';

				//Studienschwerpunkte
				var $schwerpunkte = $company.find('Studienschwerpunkte');

				if($schwerpunkte.length){
					html += '<td class="schwerpunkte">';  
					var len = parseInt($company.find('Schwerpunkt').length-1); 	
					$company.find('Schwerpunkt').each(function(index,element){

						html += $(element).text(); 
						if(parseInt(index) < parseInt(len)){ html+= ", ";}                                 
					});
				html += '</td>';             	                                         
				}

				// Themen
				var $themen = $company.find('Themen');

				if($themen.length){
					html += '<td class="themen">';  
					var len = parseInt($company.find('Thema').length-1); 	
					$company.find('Thema').each(function(index,element){

						html += $(element).text(); 
						if(parseInt(index) < parseInt(len)){ html+= ", ";}                                 
					});
				html += '</td>';             	                                         
				}

				//bewertung
				html +="<td> <span class='wertung-"+$company.find('wertung').text()+"'>"+$company.find('wetung').text()+"</span>\("+$company.find('anz_bew').text()+"\)</td>";
				html +='</tr>'
				$('#firmen_tab').append(html);	
			}); //each firma
		
	});
});

});
function getFilter(){
	var filter = new Array();
	if($('.filter-thema').length >=1){
		var len= parseInt($('.filter-thema').length) -1;
		filter +="themen="
		$('.filter-thema').each(function(index, element){
			
			filter +=$(element).text();
			if(index<len)filter+=",";
		});
		
	}

	return filter;
}

function printCompanies(data){
	

}