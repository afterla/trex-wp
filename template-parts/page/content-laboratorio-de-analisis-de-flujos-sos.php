<?php

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$page_title  = $post->post_title;
$page_url = get_permalink($post);

$view = get_query_var('view');

?>
	<div class="caja">

		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>

	<?php
		switch ($view) {
			case 'videos360':
			case 'galeria':
			case 'videos':
				get_template_part( 'template-parts/partials/analisis_sos', $view );
				break;
			default:
				get_template_part( 'template-parts/partials/analisis_sos', 'home' );
				break;
		}
	?>

	</div>