<?php
/**
 * Template Name: Plantilla Contenedora - Tecnología
 *
 * @package WordPress
 */


$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;
$grupos = get_field( 'grupos', $post );

get_header();

?>
<section class="seccion_productos">
<?php get_template_part( 'template-parts/navigation/banner', 'tecnologia' ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja">
		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>

	<?php
	foreach($grupos as $group){
		$categoria = $group['categoria'];
		$pages = $group['pages'];
	?>
		<h5><?php echo $categoria; ?></h5>
		<div class="lista_tipo_uno">
			<div class="row padd-8">

				<?php foreach($pages as $page){

					$title = $page->post_title;
					$resumen = get_field('resumen', $page);
					$img = get_field('imagen', $page);
					$url = get_permalink($page);
				?>
				<div class="col-sm-6 col-lg-3">
					<article>
						<div class="imagen">
							<a href="<?php echo $url; ?>" <?php echo $target; ?> class="full"></a>
							<img src="<?php echo $img; ?>" alt="<?php echo $title;?>">
							<div class="velo">
								<h3><span><?php echo $title;?></span></h3>
								<div class="texto">
									<?php echo $resumen;?>
								</div>
							</div>
						</div>
					</article>
				</div>
				<?php } ?>

			</div>
		</div>
	<?php
	}
	?>
	</div>


</div>
</section>

<?php

get_footer();
