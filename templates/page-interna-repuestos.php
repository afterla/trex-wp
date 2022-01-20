<?php
/**
 * Template Name: Plantilla Interna - Repuestos
 *
 * @package WordPress
 */

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;
$page_content = $post->post_content;

$imagen_interna=get_field('imagen_interna', $post);
$imagen_sumilla=get_field('imagen_sumilla', $post);
$banner_imagen=get_field('banner_imagen', $post);
$banner_url=get_field('banner_url', $post);

//the_post();
get_header();

?>
<section>
<?php get_template_part( 'template-parts/navigation/banner', 'top' ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja">

		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>

		<div class="catalogo_de_repuestos_interna">
			<div class="row padd-8">
				<div class="col-sm-6 richtext">
					<?php echo $page_content; ?>
				</div>

				<div class="col-sm-6 lateral">
				<?php if($imagen_sumilla){ ?>
					<article>
					<?php if($imagen_interna){ ?>
						<img src="<?php echo $imagen_interna;?>">
					<?php } ?>
						<div class="caja_yellow">
							<?php echo $imagen_sumilla;?>
						</div>
					</article>
				<?php } ?>
				<?php if($banner_imagen){ ?>
					<article>
						<a href="<?php echo $banner_url;?>" target="_blank"><img src="<?php echo $banner_imagen;?>"></a>
					</article>
				<?php } ?>

					<div class="formulario_lateral">

						<div class="titulo">Cotiza aquí tus repuestos</div>
						<?php echo do_shortcode( '[contact-form-7 id="1297" title="Solicitud de Repuestos"]' ); ?>

					</div>

				</div>

			</div>
		</div>

	</div>

</div>
</section>
<script src="<?php echo TEMPLATE_URL?>/js/jquery.alphanumeric.js"></script>
<script>
	$(function(){
		$('input[name=Nombre],input[name=Apellido],input[name=Cargo]').alpha({allow:" "});
		$('input[name=Telefono]').numeric({allow:".-/* "});
		$('input[name=RUC]').numeric({allow:""});
	});
</script>
<script>
$(document).ready(function() {
  if ($('.wpcf7-mail-sent-ok').length) {
  	var id=$('input[name=_wpcf7_unit_tag]').val();
	location = '<?php echo WEB_URL.'/repuestos/gracias';?>?'+id;
  }
});
</script>
<?php get_footer();
