function getFilter(){
	var filter = new Array();
	if($('.filter-thema').length >=1){
		var len= parseInt($('.filter-thema').length) -1;
		filter +="themen="
		$('.filter-thema').each(function(index, element){
			filter +=$(element).data("id");
			if(index<len && len!=0)filter+=",";
		});
		
	}
	
	if($('.filter-schwerpunkt').length >=1){
		var len= parseInt($('.filter-schwerpunkt').length) -1;
		filter +="&schwerpunkte="
		$('.filter-schwerpunkt').each(function(index, element){
			filter +=$(element).data("id");
			if(index<len)filter+=",";
		});
		
	}
	
		if($('.filter-plz').length >=1){
			var len= parseInt($('.filter-plz').length) -1;
			filter +="&plz="
			$('.filter-plz').each(function(index, element){
				filter +=$(element).data("id");
				if(index<len)filter+=",";
			});
			
		}
	return filter;
}

function printCompanies(data){
	$('#firmen_tab tbody').empty();
 	if($(data).find('Firma').length>0){	
		$(data).find('Firma').each(function(){
					var $company = $(this);
					var cid = $company.find('FID').text()
					cid = $.trim(cid);
					var filter = getFilter();
					if(filter.length > 0){
						filter = "&filter=&"+filter;
					}
					html ='<tr>';
					html += '<td><a href="./firma.php?cid='+cid+''+filter+'">'+$company.find('Name').text()+'</a></td>';
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
					html +="<td class='wertung'><span class='hiding'>"+$.trim($company.find('wertung').text())+"</span><img src='./img/Sterne/star"+$.trim($company.find('wertung').text())+".png'>("+$company.find('anz_bew').text()+"\)</td>";
					html +='</tr>'
					$('#firmen_tab tbody').append(html);
				}); //each firma

				
			}else{
				$('#firmen_tab tbody').append("<div class='error'>Ihre Auswahl brachte keine Ergebnisse</div>");
			
			}
	$('#firmen_tab').show();	
		
}

function addDBFilter(area, fclass, id, value){
	$("<li class='"+fclass+"' data-id='"+id+"'>"+value+"<span class='remove'>&nbsp;</span></li>").appendTo('.'+area);
	searchFiltered();
	
}

function removeDBFilter(area, id){
	$('.'+area+" li").each(function(){
		if($(this).data("id") == id){
			$(this).remove();
		}
	});
	searchFiltered();
}

function searchFiltered(){
	var filter = getFilter();
		$.get('xml_result.php?mode=filter&'+filter, function(data){
		printCompanies(data);
		$("#firmen_tab").trigger("update");
	});
}

function getURLParameter(sParam){
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++){
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam){
            return sParameterName[1];
        }
    }
}