<?php


$args = array(
  'name'        => 'promociones',
  'post_type'   => 'page',
  'post_status' => 'publish',
  'numberposts' => 1
);
$section = get_posts($args);

if($section){
	$slider_banners = get_field('slider_banners', $section[0]);
?>
	<div class="banner">

		<ul class="slider_promociones">
		<?php
		foreach($slider_banners as $slide){
			$banner_desktop=$slide['banner_desktop'];
			$banner_mobile=$slide['banner_mobile'];
			$titulo=$slide['titulo'];
			$subtitulo=$slide['subtitulo'];
			$url=$slide['url'];
		?>
			<li>
				<div class="banner_image banner_desktop" style="background-image:url('<?php echo $banner_desktop; ?>')"></div>
				<div class="banner_image banner_mobile" style="background-image:url('<?php echo $banner_mobile; ?>')"></div>
				<div class="container">
					<h2><?php echo $titulo; ?><br>
						<strong><?php echo $subtitulo; ?></strong>
					</h2>
					<div class="btn">
						<a href="<?php echo $url; ?>" class="full"></a>
						Ver más Información
					</div>
				</div>
			</li>
		<?php
			}
		?>
		</ul>

	</div>
<?php } ?>