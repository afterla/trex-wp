<?php
global $wpdb;

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;
$page_content = $post->post_content;

?>
<div class="caja">

	<h3><?php echo $parent_title; ?></h3>
	<h1><?php echo $page_title; ?></h1>

	<div class="catalogo_de_repuestos_interna">
		<div class="row padd-8">
			<div class="col-sm-6 richtext">
				<?php echo $page_content; ?>
			</div>

			<div class="col-sm-6 lateral">
				<div class="formulario_lateral">

					<div class="titulo">Para mayor información acerca de nuestros planes, ingresa los siguientes datos:</div>
					<?php echo do_shortcode( '[contact-form-7 id="4228" title="Solicitud de Soporte"]' ); ?>

				</div>

			</div>

		</div>
	</div>

</div>
<script src="<?php echo TEMPLATE_URL?>/js/jquery.alphanumeric.js"></script>
<script>
	$(function(){
		$('input[name=Nombre],input[name=Apellido],input[name=Provincia]').alpha({allow:" "});
		$('input[name=Telefono],input[name=Celular]').numeric({allow:".-/* "});
		$('input[name=RUC]').numeric({allow:""});
	});
</script>
<script>
<?php
//Get last id
$data_id = $wpdb->get_var('SELECT MAX(id) as data_id FROM wp_cf7_vdata');
?>
$(document).ready(function() {
  if ($('.wpcf7-mail-sent-ok').length) {
	location = '<?php echo WEB_URL.'/escribanos/gracias?'.$data_id;?>';
  }
});
</script>
