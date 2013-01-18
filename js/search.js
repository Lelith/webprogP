$(document).ready(function(){
	var cid = getURLParameter('cid');
	
		var filter = getURLParameter('filter');
		var searchString ="";
		var mode ="short";
		var filtering = false;
		if (filter !=undefined){

			var filterPLZ = getURLParameter('plz');
			var filterSW = getURLParameter('schwerpunkte');
			var filterTH = getURLParameter('themen');

		
			mode="filter";
			if(filterSW!=undefined){
				searchString +="&schwerpunkte="+filterSW;
				filtering =true;
			} 
			if(filterPLZ!=undefined){
				searchString +="&plz="+filterPLZ;
				filtering =true;
			}
			if(filterTH!=undefined){
				searchString +="&themen="+filterTH;
				filtering =true;
			}
			if(filtering==true)$('#bto').attr('href','./index.php?'+mode+'=&'+searchString);
		}
		
	if(cid==undefined){
		$.get('xml_result.php?mode='+mode+'&'+searchString, function(data){
			printCompanies(data);
			$("#firmen_tab").trigger("update"); 
		});
	}

	
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
			removeDBFilter(area, id);
		}
	
	});

	$('#plz').delegate('.plz-area', 'click', function(){
		var area= "f_plz";
		var fclass="filter-plz"
		var id=$(this).data('id');
		var value = id;	
		addDBFilter(area, fclass, id, value);
	
	});

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
	
	$('#remove_filter').click(function(event){
		$('ul.aktiv').empty();
		$.get('xml_result.php?mode=short', function(data){
			printCompanies(data);
			$("#firmen_tab").trigger("update"); 
		});
		
	});
	
	/**sortable table**/
	$("#firmen_tab").tablesorter(); 
	/***request to database***/
	$('#company-name').click(function(event){
		event.preventDefault();
		$('#search-name').fadeToggle();
	});
	$('#s-company').click(function(event){
		var searchString = $('#c-name').val();
		$.get('xml_result.php?mode=company&cname='+searchString, function(data){
			printCompanies(data);
			$("#firmen_tab").trigger("update"); 
		});

	});
	
	$('ul.aktiv').delegate('li', 'mouseover',function(){
		$(this).find('span.remove').show();
	})
	.delegate('li', 'mouseout', function(){
		$(this).find('span.remove').hide();
	})
	.delegate('li', 'click', function(){
		$(this).remove();
		searchFiltered();
	});
	
});