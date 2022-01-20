<?php
/**
 * Template Name: Plantilla Interna - Marcas Representadas
 *
 * @package WordPress
 */

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;
$page_content = $post->post_content;
$imagen = get_field( 'imagen', $post );
$video_poster = get_field( 'video_poster', $post );
$video_url = get_field( 'video_url', $post );
$relacionados = get_field( 'relacionados', $post );

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
		<div class="marcas_representadas_interna">
			<div class="row padd-8">
				<div class="col-sm-6 col-lg-3">
					<img src="<?php echo $imagen; ?>" alt="Logo <?php echo $page_title ?>" class="logo">
				</div>
				<div class="col-sm-6 col-lg-6">
					<div class="titulo">
						<?php echo $page_title ?>
					</div>
					<div class="texto">
						<?php echo $page_content ?>
					</div>
				</div>
				<div class="col-sm-6 col-lg-3">
				<?php if ($video_url){ ?>
					<div class="video">
						<a href="<?php echo $video_url;?>" class="full fancybox_video"></a>
						<img src="<?php echo $video_poster;?>" alt="Video <?php echo $page_title ?>">
						<div class="velo"></div>
					</div>
				<?php } ?>
				</div> 
			</div>
		</div>
	<?php if($relacionados){ ?>
		<div class="lista_tipo_tres">
			<div class="row padd-8">

		<?php foreach($relacionados as $relacionado){ ?>
				<div class="col-sm-6 col-lg-3 padd-8">	
					<article>
						<div class="titulo">
							<?php echo $relacionado['categoria']; ?>
						</div>
						<ul class="lista_items">
						<?php foreach($relacionado['productos'] as $producto){ ?>
							<li><a href="<?php echo get_permalink($producto); ?>"><?php echo $producto->post_title;?></a></li>
						<?php } ?>
						</ul> 	
					</article>
				</div>
		<?php } ?>

			</div>
		</div>
	<?php } ?>
	</div>

</div>
</section>

<?php get_footer();
