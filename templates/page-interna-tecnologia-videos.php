<?php
/**
 * Template Name: Plantilla Interna - Tecnología Videos
 *
 * @package WordPress
 */

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;

$tipo_video = get_field( 'tipo_video', $post );
$video = get_field( 'video', $post );

//the_post();
get_header();

?>
<section>
<?php get_template_part( 'template-parts/navigation/banner', 'tecnologia' ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja">
		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>

		<div class="video_detalle">
			<div class="row padd-8">
				<div class="col-md-7">
					<div class="contenedor_video">
						<?php echo $video; ?>
					</div>
				</div>
				<div class="col-md-5">
					<div class="detalle">
						<div class="titulo"><?php echo $post->post_title; ?></div>
						<div class="texto">
							<?php echo $post->post_content; ?>
						</div>
						<div class="btn_regresar">
							<a href="<?php echo get_permalink($parent); ?>" class="full"></a>
							<< Regresar
						</div>
					</div>
				</div>
			</div>

		<?php if($tipo_video=='360'){?>
			<div class="area_gris">
				<div class="titulo">
					¿Cómo ver videos en 360 usando un visor o cardboard?
				</div>
				<div class="row padd-8">
					<div class="col-md-3">
						El visor o cardboard te permiten <br> experimentar la realidad virtual de <br>una manera sencilla y divertida. <br>Solo sigue estos pasos:
					</div>
					<div class="col-md-3">
						<div class="elemento">
							<img src="<?php echo TEMPLATE_URL; ?>/images/tecnologia-video-detalle-img1.png">
							<div class="texto">
								<span>Dentro del video, haz clic al ícono de cardboard. Notarás que la pantalla se divide en dos pantallas más pequeñas.</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="elemento">
							<img src="<?php echo TEMPLATE_URL; ?>/images/tecnologia-video-detalle-img2.png">
							<div class="texto">
								<span>Pon tu teléfono dentro del visor o cardboard.</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="elemento">
							<img src="<?php echo TEMPLATE_URL; ?>/images/tecnologia-video-detalle-img3.png">
							<div class="texto">
								<span>Muévete hacia los lados para ver el video en 360.</span>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		<?php }?>

		</div>
		
	</div>




</div>
</section>

<?php get_footer();
