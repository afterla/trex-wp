<?php
/**
 * @package WordPress
 */

$post_name = $post->post_name;
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

//the_post();
get_header();

?>
<section>
<?php get_template_part( 'template-parts/navigation/banner', $banner ); ?>

  <div class="container" id="content_interna">
	<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<?php
	
	if(!file_exists(__DIR__.'/../template-parts/page/content-'. $post_name .'.php')) $post_name='none';

	get_template_part( 'template-parts/page/content', $post_name ); ?>

  </div>
</section>
<?php

get_footer();
