<?php
global $wpdb;

?>
	<div class="caja">
		<h1><?php echo $post->post_title; ?></h1>
		<div class="texto">
			<?php echo $post->post_content; ?>
		</div>

		<div class="formulario_escribenos">

				<?php echo do_shortcode( '[contact-form-7 id="9" title="Escríbanos"]' ); ?>

		</div>
	</div>

<script src="<?php echo TEMPLATE_URL?>/js/jquery.alphanumeric.js"></script>
<script>
	$(function(){
		$('.formulario_escribenos').jqTransform({imgPath:'jqtransformplugin/img/'});
		$('input[name=Nombre],input[name=Apellido],input[name=Cargo]').alpha({allow:" "});
		$('input[name=Telefono]').numeric({allow:".-/* "});
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