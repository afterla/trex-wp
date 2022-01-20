<?php
/**
 * Template Name: Plantilla Interna - Talleres
 *
 * @package WordPress
 */

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title  = $post->post_title;
$page_url = get_permalink($post);

$view = get_query_var('view');
$texto_intro = get_field('texto_intro', $post);

//the_post();
get_header();

?>
<section>
<?php get_template_part( 'template-parts/navigation/banner', 'talleres' ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja">

		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>

		<div class="talleres">
			<div class="titular">
				<?php echo $texto_intro; ?>
			</div>
	<?php
		switch ($view) {
			case 'videos360':
			case 'galeria':
			case 'videos':
				get_template_part( 'template-parts/partials/talleres', $view );
				break;
			default:
				get_template_part( 'template-parts/partials/talleres', 'home' );
				break;
		}
	?>
		</div>

	</div>

</div>
</section>

<?php get_footer();
