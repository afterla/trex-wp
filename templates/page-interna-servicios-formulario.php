<?php
/**
 * Template Name: Plantilla Interna - Formulario Asesoria
 *
 * @package WordPress
 */
global $wpdb;

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;
$page_content = $post->post_content;

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
		<div class="tecnologia_box">
			<div class="row padd-8">
				<div class="col-md-6">
					
					<?php echo $page_content; ?>
						
				</div>
				<div class="col-md-6 lateral">
					<div class="formulario_lateral">
							<div class="titulo">
								Solicite su acceso
							</div>

					<?php echo do_shortcode( '[contact-form-7 id="3278" title="Formulario de Asesoría"]' ); ?>

						</div>
				</div>
			</div>
		</div>
	<?php if($servicios){ ?>
		<div class="lista_tipo_uno">
			<div class="row padd-8">
			<?php foreach($servicios as $servicio){

				$title = $servicio['titulo'];
				$resumen = $servicio['resumen'];
				$imagen = $servicio['imagen'];
			?>
			<div class="col-sm-6 col-lg-3">
				<article>
					<div class="imagen" style="cursor: default;">
						<img src="<?php echo $imagen; ?>" alt="<?php echo $title;?>">
						<div class="velo">
							<h3><span><?php echo $title;?></span></h3>
							<div class="texto">
								<?php echo $resumen;?>
							</div>
						</div>
					</div>
					<div class="parrafo">
						<?php echo $resumen; ?>
					</div>
				</article>
			</div>
			<?php }?>
			</div>
		</div>
	<?php } ?>

	<?php if($tutoriales){ ?>
		<div class="tutoriales_box" id="tutoriales_box">
			<h5>
				Tutoriales
			</h5>

			<div class="row padd-10">
			<?php foreach($tutoriales as $tutorial){
				$video = $tutorial['video'];
			?>
				<div class="col-md-6">
					<div class="video">
						<div class="contenedor_video">
							<?php echo $video; ?>
						</div>
					</div>
				</div>
			<?php }?>
			</div>
		</div>
	<?php } ?>

	<?php if($tips){ ?>
		<div class="lista_tipo_uno tips_box">
			<h5>Tips PCC</h5>
			<div class="row padd-8">
			<?php foreach($tips as $tip){

				$title = $tip['titulo'];
				$resumen = $tip['resumen'];
				$imagen = $tip['imagen'];
				$url = get_permalink($tip['pagina']);
			?>
				<div class="col-sm-6 padd-8">
					<article>
						<div class="imagen">
							<a href="<?php echo $url;?>" class="full"></a>
							<img src="<?php echo $imagen; ?>" alt="Ferreyros">
							<div class="velo">
								<h3><span><?php echo $title;?></span></h3>
							</div>
						</div>
					</article>
				</div>
			<?php }?>
			</div>
		</div>
	<?php } ?>

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
<?php
//Get last id
$data_id = $wpdb->get_var('SELECT MAX(id) as data_id FROM wp_cf7_vdata');
?>
$(document).ready(function() {
  if ($('.wpcf7-mail-sent-ok').length) {
	location = '<?php echo WEB_URL.'/servicios/gracias?'.$data_id;?>';
  }
});
</script>
<?php get_footer();
