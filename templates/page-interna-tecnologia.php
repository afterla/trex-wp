<?php
/**
 * Template Name: Plantilla Interna - Tecnología
 *
 * @package WordPress
 */

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title = $post->post_title;
$images = get_field( 'images', $post );

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
				<div class="col-md-9 richtext">
					<?php echo $post->post_content; ?>
				</div>
			<?php if($images){ ?>
				<div class="col-md-3">
				<?php foreach($images as $image){ ?>
					<img src="<?php echo $image['url']; ?>"><br>
				<?php } ?>
				</div>
			<?php } ?>
			</div>
		</div>

	</div>

</div>
</section>

<?php get_footer();
