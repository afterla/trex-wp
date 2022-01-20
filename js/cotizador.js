var url_base = WEB_URL+'/wp-json/cotizador/v1/';

$( document ).ready(function() {


  Modalidad_list();
  Marca_list();
  Hidden_fields();
  Events();

});

function Modalidad_list(){
  $.ajax({
	url: url_base+'modalidad/list',
	type: 'GET',
	dataType: "json",
	success: function(data) {
		//console.log(data);

		var html='';
		$.each(data, function(k, obj) {
			html += '<option value="'+obj.id+'" rel="'+obj.type+'">'+obj.name+'</option>';
		});
		html = '<option "">Modalidad</option>'+html;

		$('select[name=Modalidad]').html(html);
		if(typeof PROMO !== 'undefined'){
			var id = $('select[name=Modalidad] option[rel=promocion]').val();
			$('select[name=Modalidad]').val(id);
			Promocion_load(id);
		}
		if(typeof MODALIDAD !== 'undefined'){
			$('select[name=Modalidad]').val(MODALIDAD);
			Familia_list(MODALIDAD);
		}
		$('select[name=Modalidad]').jqTransSelectRefresh();
	}
  });
}

function Marca_list(){
  $.ajax({
	url: url_base+'marca/list',
	type: 'GET',
	dataType: "json",
	success: function(data) {
		//console.log(data);

		var html='';
		$.each(data, function(k, obj) {
			html += '<option value="'+obj.id+'">'+obj.name+'</option>';
		});
		html = '<option "">Línea/Marca</option>'+html;

		$('select[name=Marca]').html(html);
		if(typeof MARCA !== 'undefined'){
			$('select[name=Marca]').val(MARCA);
		}
		$('select[name=Marca]').jqTransSelectRefresh();
	}
  });
}

function Modelo_list(id){
  var marca = $('select[name=Marca]').val();
  $.ajax({
	url: url_base+'modelo/list/'+id,
	type: 'GET',
	dataType: "json",
	data: {'marca': marca},
	success: function(data) {
		//console.log(data);

		var html='';
		$.each(data, function(k, obj) {
			html += '<option value="'+obj.id+'">'+obj.name+'</option>';
		});
		html = '<option "">Modelo</option>'+html;

		$('select[name=Modelo]').html(html);
		if(typeof MODELO !== 'undefined'){
			$('select[name=Modelo]').val(MODELO);
		}
		$('select[name=Modelo]').select2();
	}
  });
}

function Familia_list(id){
  $.ajax({
	url: url_base+'familia/list/'+id,
	type: 'GET',
	dataType: "json",
	success: function(data) {
		//console.log(data);

		var html='';
		$.each(data, function(k, obj) {
			if(obj.group){
				if(k>0) html += '</optgroup>';
				html += '<optgroup label="'+obj.name+'">';
			}
			else
				html += '<option value="'+obj.id+'">'+obj.name+'</option>';
		});
		if(data.length>0) html += '</optgroup>';

		html = '<option "">Familia</option>'+html;

		$('select[name=Familia]').html(html);
		if(typeof FAMILIA !== 'undefined'){
			$('select[name=Familia]').val(FAMILIA);
			Modelo_list(FAMILIA);
		}
		$('select[name=Familia]').jqTransSelectRefresh();
	}
  });
}

function Promocion_list(id){

  $.ajax({
	url: url_base+'promocion/list/'+id,
	type: 'GET',
	dataType: "json",
	success: function(data) {
		//console.log(data);

		var html='';
		$.each(data, function(k, obj) {
			if(obj.group){
				if(k>0) html += '</optgroup>';
				html += '<optgroup label="'+obj.name+'">';
			}
			else
				html += '<option value="'+obj.id+'">'+obj.name+'</option>';
		});
		if(data.length>0) html += '</optgroup>';

		html = '<option "">Promoción</option>'+html;

		$('select[name=Promocion]').html(html);
		if(typeof PROMO !== 'undefined'){
			$('select[name=Promocion]').val(PROMO);
		}
		$('select[name=Promocion]').jqTransSelectRefresh();
	}
  });
}

function Producto_load(id){
	$('#dd_promo').hide();
	$('#dd_familia').show();
	$('#dd_marca').show();
	$('#dd_modelo').show();
	Familia_list(id);
}

function Promocion_load(id){
	$('#dd_promo').show();
	$('#dd_familia').hide();
	$('#dd_marca').hide();
	$('#dd_modelo').hide();
	Promocion_list(id);
}

function Hidden_fields(){
	if(typeof utm_campaign !== 'undefined') $('input[name=utm_campaign]').val(utm_campaign);
	if(typeof utm_source !== 'undefined') $('input[name=utm_source]').val(utm_source);
	if(typeof utm_medium !== 'undefined') $('input[name=utm_medium]').val(utm_medium);
	if(typeof utm_content !== 'undefined') $('input[name=utm_content]').val(utm_content);
}

function Events(){

  $('select[name=Modalidad]').on({
	change: function(){
		var id = $(this).val();
		var type = $('select[name=Modalidad] option:selected').attr('rel');
		console.log(type);
		if(type=='producto'){
			Producto_load(id);
		}
		if(type=='promocion'){
			Promocion_load(id);
		}
	}
  });

  $('select[name=Marca]').on({
	change: function(){
		var id = $('select[name=Familia]').val();
		console.log($('select[name=Familia]'));
		Modelo_list(id);
	}
  });

  $('select[name=Familia]').on({
	change: function(){
		var id = $(this).val();
		Modelo_list(id);
	}
  });

}

$(document).ajaxError(function( event, request, settings, exception) {
  //alert('Ha ocurrido un error interno en la aplicaci\xf3n. Por favor, int\xe9ntelo mas tarde.');
  console.log("url: " + settings.url);
  console.log("error: " + exception);
  console.log("data: " + request.responseText);
});