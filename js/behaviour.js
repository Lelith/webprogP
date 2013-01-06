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
	
	//banner rotation
	var source=new EventSource("banner_rotation.php");
	source.onmessage=function(event)
	  {
		console.log("on message: "+event.data);
		$('#advertise').empty();	
	  	$('#advertise').append(event.data + "<br>");
	  };
	
});
