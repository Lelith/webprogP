$(document).ready(function(){
	$('#schwerpunkt').show();
	$('#tabs li a').click(function(event){
		event.preventDefault();
		var link =$(this).attr('href');	
		$('.auswahl:visible').hide();
		$(link).show();
	});


$('#schwerpunkt').delegate('.form_row input', 'click', function(){
	var area = "f_sw";
	var fclass ="filter-schwerpunkt";
	var id = $(this).data("id");
	var value = $(this).val();
	
	if($(this).is(':checked')){
			addDBFilter(area, fclass, id, value);
	}else{
		console.log("not checked")
		removeDBFilter(area, id);
	}
	
});

/*$('#plz').delegate('.form_row input', 'click', function(){
	if($(this).is(':checked')){
			console.log("plz checked: "+$(this).data("id"));
	}else{
			console.log("schwerpunkt nchecked: "+$(this).data("id"));
	}
	
});*/

$('#themen').delegate('select', 'change', function(){
	var area = "f_thema";
	var fclass ="filter-thema";
	
 $("select option:selected").each(function () {
	var id = $(this).data("id");
	var value = $(this).text();
	if(id !=undefined){
		addDBFilter(area, fclass, id, value);
	}
	
	
});
	
});

$('#firmen').click(function(event){
	event.preventDefault();
	$.get('xml_result.php?mode=short', function(data){
		printCompanies(data);
	});
});


$("#firmen_filter").click(function(event){
	event.preventDefault();
	var filter = getFilter();
	$.get('xml_result.php?mode=filter&'+filter, function(data){
		printCompanies(data);
	});
});

/***** Bewertungen *****/
$('.stars li').hover(function(){
	var myClass =$(this).attr('class');
	$('.stars').css("background-image", "url(./img/Sterne/"+myClass+".png)");
});

$('.stars li').click(function(){
	$('.stars li').each(function(){
		$(this).removeClass('active');
	});
	$(this).addClass('active');
	$('.stars').addClass('clicked');
});
$('.stars').mouseout(function(){
	if(!$(this).hasClass('clicked'))$('.stars').css("background-image", "url(./img/Sterne/0sterne.png)");
});


});
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
	return filter;
}

function printCompanies(data){
	$('#firmen_tab').empty();
	$('#firmen_tab').append("<thead><tr>\n<th>Name</th>\n<th>PLZ</th>\n<th>Schwerpunkte</th>\n<th>Themen</th>\n<th>Bewertung</th>\n</tr></thead>");
	$(data).find('Firma').each(function(){
				var $company = $(this);
				var cid = $company.find('FID').text()
				cid = $.trim(cid);
				html ='<tr>';
				html += '<td><a href="./firma.php?cid='+cid+'">'+$company.find('Name').text()+'</a></td>';
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
		
}

function addDBFilter(area, fclass, id, value){
	$("<li class='"+fclass+"' data-id='"+id+"'>"+value+"</li>").appendTo('.'+area);
	
}

function removeDBFilter(area, id){
	$('.'+area+" li").each(function(){
		if($(this).data("id") == id){
			$(this).remove();
		}
	})
}