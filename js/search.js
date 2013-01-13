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
	});
	
	/***request to database***/
	
	$('#s-company').click(function(event){
		var searchString = $('#c-name').val();
		$.get('xml_result.php?mode=company&cname='+searchString, function(data){
			printCompanies(data);
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
	
	$('ul.aktiv').delegate('li', 'mouseover',function(){
		$(this).find('span.remove').show();
	})
	.delegate('li', 'mouseout', function(){
		$(this).find('span.remove').hide();
	})
	.delegate('li', 'click', function(){
		$(this).remove();
	});
	//banner rotation
	var source=new EventSource("banner_rotation.php");
	source.onmessage=function(event)
	  {
		$('#advertise').empty();	
	  	$('#advertise').append(event.data + "<br>");
	  };
	
});
