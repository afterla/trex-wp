<?php
/**
 * Template Name: Plantilla de Minería
 *
 * @package WordPress
 */


$banners = get_field('banners', $post);

//the_post();
get_header();

?>
<section class="seccion_nosotros">
<?php get_template_part( 'template-parts/navigation/banner', 'top' ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

		<?php if($banners){?>
			<div class="banner">
				<ul class="">
				<?php foreach($banners as $banner){
					$img = $banner['imagen'];
					$lnk = $banner['link'];
				?>
					<li>
						<a href="<?php echo $lnk; ?>"><img src="<?php echo $img; ?>"></a>		
					</li>
				<?php
					//break;
					}
				?>
				</ul>
			</div>
		<?php }?>
</div>
</section>
<?php

get_footer();
