<?php
/**
 * Template Name: Thank you page
 *
 * @package WordPress
 */

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

		<div class="richtext">
			<?php echo $post->post_content; ?>
		</div>
	</div>

</div>
</section>

<?php get_footer();
