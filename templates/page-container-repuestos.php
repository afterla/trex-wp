<?php
/**
 * Template Name: Plantilla Contenedora - Repuestos
 *
 * @package WordPress
 */

$args = array(
	'post_parent' => $post->ID,
	'post_type'   => 'page', 
	'post_status' => 'publish', 
	'numberposts' => 30,
	'orderby'	=> 'menu_order',
	'order'		=> 'ASC'
);
$pages = get_posts( $args );

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;

get_header();

?>
<section>
<?php get_template_part( 'template-parts/navigation/banner', 'top' ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja">
		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>
	
	<?php if($pages){ ?>
		<div class="catalogo_de_repuestos">
			<div class="row padd-8">
			<?php foreach($pages as $page){

				$title = $page->post_title;
				//$resumen = get_field('resumen', $page);
				$img = get_field('imagen', $page);
				$url = get_permalink($page);
			?>
				<div class="col-sm-6 col-lg-3">
				<article>									
					<div class="imagen">
						<a href="<?php echo $url ?>" class="full"></a>
						<img src="<?php echo $img ?>" alt="<?php echo $title ?>">
						<div class="velo">
							<h3><span><?php echo $title ?></span></h3>											
						</div>
					</div>							
				</article>
				</div>
			<?php } ?>
			</div>

			<div class="row padd-8">
				<div class="col-md-6 offset-md-6">
					<div class="btn_politicas">
						<a href="<?php echo TEMPLATE_URL?>/pdf/politicas_de_devolucion.pdf" target="_blank" class="full"></a>
						<span>
							ver Políticas de Devoluciones 										
						</span>
						<div class="ico"></div>
					</div>
				</div>
			</div>

		</div>
	<?php } ?>

	</div>

</div>
</section>

<?php

get_footer();
