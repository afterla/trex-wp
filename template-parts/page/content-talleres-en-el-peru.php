<?php

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
?>
	<div class="caja">

		<h3><?php echo $parent_title; ?></h3>
		<h1><?php echo $page_title; ?></h1>

		<div class="talleres">
		<?php if($pages){ ?>
			<div class="mapa_peru">

			<?php
				foreach($pages as $page){
					$titulo = $page->post_title;
					$ciudad = get_field('ciudad', $page);
			?>
				<div class="caja_pais <?php echo $ciudad;?>">
					<a href="<?php echo get_permalink($page);?>" class="full"></a>
					<div class="titulo">
						<?php echo $titulo;?>
					</div>
					<div class="point"></div>
					<div class="line1"></div>
					<div class="line2"></div>
				</div>
			<?php } ?>

			</div>
		<?php } ?>
		</div>

	</div>