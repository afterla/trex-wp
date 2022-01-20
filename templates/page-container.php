<?php
/**
 * Template Name: Plantilla Contenedora
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

$post_name = $parent->post_name;
switch ($post_name) {
	case 'tecnologia':
		$banner = 'tecnologia'; break;
	case 'talleres':
		$banner = 'video'; break;
	case 'trabaje-con-nosotros':
		$banner = 'trabaje'; break;
	default:
		$banner = 'top'; break;
}


$parent_title=$parent->post_title;
$page_title = $post->post_title;

get_header();

?>
<section class="seccion_productos">
<?php get_template_part( 'template-parts/navigation/banner', $banner ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja">
		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>

	<?php if($pages){?>
		<div class="lista_tipo_uno">
			<div class="row padd-8">

				<?php foreach($pages as $page){

					$title = $page->post_title;
					$resumen = get_field('resumen', $page);
					$img = get_field('imagen', $page);
					$url = get_field('url', $page);
					$href = $url? $url: get_permalink($page);
					$target = $url? 'target="_blank"': null;
				?>
				<div class="col-sm-6 col-lg-3">
					<article>
						<div class="imagen">
							<a href="<?php echo $href; ?>" <?php echo $target; ?> class="full"></a>
							<img src="<?php echo $img; ?>" alt="<?php echo $title;?>">
							<div class="velo">
								<h3><span><?php echo $title;?></span></h3>
								<div class="texto">
									<?php echo $resumen;?>
								</div>
							</div>
						</div>
						<div class="parrafo">
							<?php echo $resumen;?>
						</div>
					</article>
				</div>
				<?php }?>

			</div>
		</div>
	<?php }?>
	</div>

</div>
</section>

<?php

get_footer();
