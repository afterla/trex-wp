<?php
/**
 * Template Name: Plantilla Contenedora - Promociones
 *
 * @package WordPress
 */



$categorias = get_field('categorias', $post);

get_header();
?>
<section class="seccion_promociones">
<?php get_template_part( 'template-parts/navigation/banner', 'promociones' ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja">
		<h3><?php echo $post->post_title; ?></h3>
	
	<?php if($categorias){ ?>
			<?php foreach($categorias as $cat){
				$titulo = $cat['titulo'];
				$promociones = $cat['promociones'];
				if(!$promociones) continue;

			?>
			<h4><?php echo $titulo;?></h4>
			<div class="catalogo_de_promociones">
				<div class="row padd-8">
			<?php foreach($promociones as $promo){

				$titulo = $promo->post_title;
				$img = get_field('imagen_caja', $promo);
				$url = get_permalink($promo);
			?>
					<div class="col-sm-6 col-lg-3">
					<article>
						<div class="imagen">
							<a href="<?php echo $url;?>" class="full"></a>
							<img src="<?php echo $img;?>" alt="<?php echo $titulo;?>">
							<div class="velo">
								<h3><span><?php echo $titulo;?></span></h3>
							</div>
						</div>
					</article>
					</div>
			<?php } ?>

				</div>
			</div>
		<?php } ?>
	<?php } ?>


	</div>

</div>
</section>

<?php

get_footer();
