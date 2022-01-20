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
	<div class="catalogo_de_logos">
		<div class="row padd-8">

			<?php foreach($pages as $page){
				$title = $page->post_title;
				$img = get_field('imagen', $page);
				$url = get_permalink($page);
			?>

			<div class="col-sm-6 col-lg-3">
			<article>
				<div class="imagen">
					<a href="<?php echo $url;?>" class="full"></a>
					<?php if($img){ ?>
					<img src="<?php echo $img;?>" alt="Ferreyros">
					<?php } ?>
					<div class="velo">
						<h3><span><?php echo $title;?></span></h3>
					</div>
				</div>
			</article>
			</div>
			<?php }?>
			
		</div>
	</div>
	<?php }?>
</div>
