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

$lat = get_field('lat', $post);
$lng = get_field('lng', $post);
?>
<div class="caja">
	<h1><?php echo $post->post_title; ?></h1>
	<div class="texto">
		<?php echo $post->post_content; ?>
	</div>
	<div class="locales_wrapper">
		<div class="row padd-8">
			<div class="col-md-3">
				<ul class="lista_locales">
				<?php
					foreach ($pages as $page){
				?>
					<li>
						<a href="<?php echo get_permalink($page); ?>" class="full"></a>
						<span>
							<?php echo $page->post_title;?>
						</span>
					</li>
				<?php
					}
				?>
				</ul>
			</div>
			<div class="col-md-9">
				<div class="mapa">
					<div id="ubication_map"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
 	$(function(){

	<?php if(isset($lat) && isset($lng)){ ?>
		var uluru = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};
		var map = new google.maps.Map(document.getElementById('ubication_map'), {
			zoom: 16,
			center: uluru
		});
		var marker = new google.maps.Marker({
			position: uluru,
			map: map
		});
	<?php } ?>

 	});
</script>