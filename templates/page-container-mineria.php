<?php
/**
 * Template Name: Plantilla Contenedora - Minería
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


		<?php if($pages){?>
		<div class="lista_tipo_dos">
			<div class="row padd-8">
				<?php foreach($pages as $page){
					$title = $page->post_title;
					$enlaces = get_field('enlaces', $page);
					$img = get_field('imagen', $page);
					$url = get_field('url', $page);
					$target = 'target="_blank"';
					if(empty($url)){
						$url = get_permalink($page);
						$target = null;
					}
				?>
				<div class="col-sm-6 col-lg-3 padd-8">	
					<article>
						<div class="imagen">
							<!--<a href="<?php echo $url; ?>" <?php echo $target; ?> class="full"></a>/-->
							<img src="<?php echo $img;?>">
							<div class="titulo"><?php echo $title;?></div>
						</div>
						<?php if($enlaces){ ?>
						<div class="fade-content">
							<ul class="lista_items">
								<?php foreach($enlaces as $link){ ?>
								<li><a href="<?php echo $link['url'];?>"><?php echo $link['titulo'];?></a></li>
								<?php } ?>
							</ul>
							<?php if(count($enlaces)>4){ ?>
							<div class="fade-anchor"><span class="fade-anchor-text">Ver más...</span></div>
							<div class="vermenos">Ver menos</div>
							<?php } ?>
						</div>
						<?php } ?>
					</article>
				</div>
				<?php
					//break;
					}
				?>
			</div>
		</div>
		<?php }?>

</div>
</section>
<?php

get_footer();
