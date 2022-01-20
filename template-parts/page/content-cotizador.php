<?php
global $wpdb;

$model_id = get_query_var( 'id', null );
$parent_id = get_query_var( 'parent', null );
$PROMO = get_query_var( 'promo', null );

$utm_campaign = get_query_var( 'utm_campaign', null );
$utm_source = get_query_var( 'utm_source', null );
$utm_medium = get_query_var( 'utm_medium', null );
$utm_content = get_query_var( 'utm_content', null );

if(!empty($model_id) && !empty($parent_id)){
	$product = get_post($model_id);
	$marcas = get_the_terms($product, 'marca');
	$parents = get_top_parents( $parent_id );
	$MODALIDAD = $parents[1];
	$FAMILIA = count($parents)>3? $parents[3]: $parents[2];
	if(count($marcas)>0) $MARCA = $marcas[0]->term_id;
	$MODELO = $model_id;
}
?>
	<div class="caja">
		<h1><?php echo $post->post_title; ?></h1>
		<div class="texto">
			<?php echo $post->post_content; ?>
		</div>

		<div class="formulario_cotizador">
				<?php echo do_shortcode( '[contact-form-7 id="2012" title="Cotizador Ferreyros"]' ); ?>
		</div>
	</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="<?php echo TEMPLATE_URL?>/js/jquery.alphanumeric.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>/js/cotizador.js"></script>
<script>
<?php
if(isset($MODALIDAD)) echo "var MODALIDAD = '$MODALIDAD';\n";
if(isset($MARCA)) echo "var MARCA = '$MARCA';\n";
if(isset($FAMILIA)) echo "var FAMILIA = '$FAMILIA';\n";
if(isset($MODELO)) echo "var MODELO = '$MODELO';\n";
if(isset($PROMO)) echo "var PROMO = '$PROMO';\n";

if(isset($utm_campaign)) echo "var utm_campaign = '$utm_campaign';\n";
if(isset($utm_source)) echo "var utm_source = '$utm_source';\n";
if(isset($utm_medium)) echo "var utm_medium = '$utm_medium';\n";
if(isset($utm_content)) echo "var utm_content = '$utm_content';\n";
?>
$(document).ready(function() {
	$('.campo_select, .acepto').jqTransform({imgPath:'jqtransformplugin/img/'});
	$('input[name=Nombre],input[name=Apellido],input[name=Cargo]').alpha({allow:" "});
	$('input[name=Telefono]').numeric({allow:".-/* "});
	$('input[name=RUC]').numeric({allow:""});
	$('select[name=Modelo]').select2();
	
	$('.wpcf7-form').submit(function(e){
		if($('#dd_modalidad').is(':visible')) $('input[name=Modalidad_Nombre]').val($('select[name=Modalidad] option:selected').text());
		if($('#dd_marca').is(':visible')) $('input[name=Marca_Nombre]').val($('select[name=Marca] option:selected').text());
		if($('#dd_familia').is(':visible')) $('input[name=Familia_Nombre]').val($('select[name=Familia] option:selected').text());
		if($('#dd_modelo').is(':visible')) $('input[name=Modelo_Nombre]').val($('select[name=Modelo] option:selected').text());
		if($('#dd_promo').is(':visible')) $('input[name=Promocion_Nombre]').val($('select[name=Promocion] option:selected').text());
	});
	
});
</script>
<script>
<?php
//Get last id
$data_id = $wpdb->get_var('SELECT MAX(id) as data_id FROM wp_cf7_vdata');
?>
$(document).ready(function() {
  if ($('.wpcf7-mail-sent-ok').length) {
	location = '<?php echo WEB_URL.'/cotizador/gracias?'.$data_id;?>';
  }
});
</script>