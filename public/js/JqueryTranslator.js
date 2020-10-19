$.getJSON("../public/json/lenguaje.json", function(json){

//Lenguaje por defecto de la página sessionStorage.setItem("lang", "idioma")"
if(!localStorage.getItem("lenguaje")){
    localStorage.setItem("lenguaje", "en");
  }

  var lenguaje = localStorage.getItem("lenguaje");
  var doc = json;
  $('.lenguaje').each(function(index, element){
    $(this).text(doc[lenguaje][$(this).attr('key')]);
  });//Each

	$('.translate').click(function(){
		localStorage.setItem("lenguaje", $(this).attr('id')) ;
    var lenguaje = $(this).attr('id');
    var doc = json;
      $('.lenguaje').each(function(index, element){
        $(this).text(doc[lenguaje][$(this).attr('key')]);
      }); //Each
  }); //Funcion click
});//Get json AJAX