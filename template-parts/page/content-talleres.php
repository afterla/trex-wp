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


	<?php if($pages){?>
	<div class="lista_tipo_uno">
		<div class="row padd-8">
			<?php foreach($pages as $page){
				$title = $page->post_title;
				$resumen = get_field('resumen', $page);
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
						<a href="<?php echo $url; ?>" <?php echo $target; ?> class="full"></a>
						<img src="<?php echo $img; ?>" alt="<?php echo $img; ?>">
						<div class="velo">
							<h3><span><?php echo $title;?></span></h3>
							<div class="texto">
								<?php echo $resumen;?>
							</div>
						</div>
					</div>
					<div class="parrafo">
						<?php echo $resumen;?>
					</div>
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
