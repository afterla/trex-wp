var url_base = WEB_URL+'/wp-json/comparador/v1/';

$( document ).ready(function() {

  $(".comparar .campo_check").on({
	click: function(){
		var id = $(this).attr('rel');
		if($('#chk_'+id).is(':checked'))
			Comparar_add(id);
		else
			Comparar_del(id);
	}
  });

  $(".seccion_comparar .close").on({
	click: function(){
		var id = $(this).attr('rel');
		Comparar_del(id, true);
	}
  });

});

function Comparar_list(){

	$.ajax({
		url: url_base+'list',
		type: 'GET',
		dataType: "json",
		success: function(data) {

			if(Object.keys(data).length>1){
				var html='';
				$.each(data, function(k, item) {
					html += '<div class="col-3 item"><div class="imagen"><img src="'+item.image+'"></div><div class="nombre">'+item.title+'</div><div class="close" rel="'+k+'"></div></div>';
				});
				url  = data[Object.keys(data)[0]].url+'?parent='+$(".comparador").attr('parent')+'&view=comparar';
				html+= '<div class="col-3"><div class="btn_comparar"><a href="'+url+'#ancla" class="full"></a>Comparar</div></div>';

				//console.log(html);
				$('.comparador div div').html(html);
				$(".comparador").addClass("activo");

				$(".comparador .close").on({
				click: function(){
						var id = $(this).attr('rel');
						Comparar_del(id);
					}
				});
			}
			else{
				$(".comparador").removeClass("activo");
			}

		}
	});
	
}

function Comparar_add(id){

	$.ajax({
	url: url_base+'add/'+id,
	type: 'POST',
	dataType: "json",
	success: function(data) {
			if(data){
				Comparar_list();
			}
		}
	});

}

function Comparar_del(id, reload){

	$.ajax({
	url: url_base+'del/'+id,
	type: 'POST',
	dataType: "json",
	success: function(data) {
			if(reload){
				if(data==0){
					location.href=page_url;
				}
				else
					location.reload();
			}
			else{
				$('#chk_'+id).removeAttr('checked');
				Comparar_list();
			}
		}
	});

}

$(document).ajaxError(function( event, request, settings, exception) {
  //alert('Ha ocurrido un error interno en la aplicaci\xf3n. Por favor, int\xe9ntelo mas tarde.');
  console.log("url: " + settings.url);
  console.log("error: " + exception);
  console.log("data: " + request.responseText);
});