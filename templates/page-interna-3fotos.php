<?php
/**
 * Template Name: Plantilla Interna - 3 Fotos
 *
 * @package WordPress
 */

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;
$page_content = $post->post_content;

$imagen1 = get_field('imagen1', $post);
$imagen2 = get_field('imagen2', $post);
$imagen_lateral = get_field('imagen_lateral', $post);

//the_post();
get_header();

?>
<section>
<?php get_template_part( 'template-parts/navigation/banner', 'top' ); ?>

  <div class="container">
	<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja content_mineria_ilegal">
		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>
		<div class="row">
			<div class="col-md-<?php echo ($imagen_lateral? 6: 9);?>">
				<div class="texto richtext">
			<?php echo $page_content; ?>
				</div>
			</div>
			<div class="col-md-<?php echo ($imagen_lateral? 6: 3);?>">
			  <div class="row padd-8">
				<?php if($imagen1 && $imagen2){ ?>
				<div class="col-md-<?php echo ($imagen_lateral? 6: 12);?>">
					<?php if($imagen1){ ?>
						<img src="<?php echo $imagen1;?>" alt="Valores">
						<br>
					<?php } ?>
					<?php if($imagen2){ ?>
						<img src="<?php echo $imagen2;?>" alt="Valores">
						<br>
					<?php } ?>
				</div>
				<?php } ?>
				<?php if($imagen_lateral){ ?>
				<div class="col-md-6">
					<img src="<?php echo $imagen_lateral;?>" alt="Valores">
				</div>
				<?php } ?>
			  </div>
			</div>
		</div>
	</div>

  </div>
</section>

<?php get_footer();
