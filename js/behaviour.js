$(document).ready(function(){
	$('#schwerpunkt').show();
	$('#tabs li a').click(function(event){
		event.preventDefault();
		var link =$(this).attr('href');	
		$('.auswahl:visible').hide();
		$(link).show();
	});
});

var firmenArr = new Array();
var anfrage = null; 
try { 
  anfrage = new XMLHttpRequest(); 
} catch (err_ff) { 
  try { 
    anfrage = new ActiveXObject("Msxml2.XMLHTTP"); 
  } catch (err_ms1) { 
    try { 
      anfrage = new ActiveXObject("Microsoft.XMLHTTP"); 
    } catch (err_all) { 
      anfrage = null; 
    } 
  } 
} 
if (anfrage == null) { 
  alert ("Sie verwenden einen nicht Ajax-fähigen Browser."); 
}else{
	console.log("ajax aufgebaut");
}

var url = "xml_result.php?mode=short"; 
anfrage.open ("GET", url, false); 
anfrage.onreadystatechange = holeListe(); 
anfrage.send (null);


function holeListe() { 
  // Antwort angekommen? 
  if (anfrage.readyState == 4) { 
    // Antwort akzeptabel? 
    if (anfrage.status == 200) { 
      warten = false; 
      // Antwort speichern 
      var firmenXML = anfrage.responseXML; 
      // Über alle <land>-Tags im DOM-Baum iterieren 
      var firmen = firmenXML.getElementsByTagName("Firma"); 
      for (i = 0; i < firmen.length; i++) { 
        var id = firmen[i].getElementsByTagName("FID") 
                 [0].firstChild.nodeValue; 
 
        var Name = firmen[i].getElementsByTagName 
                 ("Name")[0].firstChild.nodeValue; 
        var eintrag = new Array(id, land); 
        firmenArr.push (eintrag); 
      } 
      // Anzeige löschen 
      loescheListe(); 
      // Alle Staaten eintragen (leerer Filter!) 
      filterListe(); 
    } else { 
      alert ("Staatenliste nicht verfuegbar!"); 
    } 
  } 
}