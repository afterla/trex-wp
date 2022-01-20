<?php
/**
 * Template Name: Plantilla Interna - Tecnología Juegos
 *
 * @package WordPress
 */

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;

$imagen_app = get_field( 'imagen_app', $post );
$url_ios = get_field( 'url_ios', $post );
$url_android = get_field( 'url_android', $post );

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

		<div class="detalle_parrafos">
			<div class="row padd-8">
				<div class="col-md-7">
					<?php echo $post->post_content;?>
				<div class="btn_regresar">
					<a href="<?php echo get_permalink($parent); ?>" class="full"></a>
					<< Regresar
				</div>
				</div>
				<div class="col-md-5">
				<?php if($imagen_app){ ?>
					<div class="imagen"><img src="<?php echo $imagen_app; ?>" alt="apps"></div>
					<div class="clear"></div>
				<?php } ?>
					<div class="row store">
						<div class="col-5 offset-2">
						<?php if($url_ios){ ?>
							<div class="btn_app">
								<a href="<?php echo $url_ios; ?>" target="_blank" class="full"></a>
								<img src="<?php echo TEMPLATE_URL; ?>/images/appstore.jpg" alt="appstore">
							</div>
						<?php } ?>
						</div>
						<div class="col-5">
						<?php if($url_android){ ?>
							<div class="btn_app">
								<a href="<?php echo $url_android; ?>" target="_blank" class="full"></a>
								<img src="<?php echo TEMPLATE_URL; ?>/images/googleplay.jpg" alt="appstore">
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>

</div>
</section>

<?php get_footer();
