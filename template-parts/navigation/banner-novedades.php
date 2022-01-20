<?php

$args = array(
  'name'        => 'novedades',
  'post_type'   => 'page',
  'post_status' => 'publish',
  'numberposts' => 1
);
$section = get_posts($args);

if($section){
	$section=$section[0];
	$banner_desktop=get_field('banner_desktop', $section);
	$banner_mobile=get_field('banner_mobile', $section);
	$banner_title=get_field('banner_title', $section);
	if(!$banner_title) $banner_title = $section->post_title;
?>
	<div class="banner">
		<div class="banner_image banner_desktop" style="background-image:url('<?php echo $banner_desktop; ?>')"></div>
		<div class="banner_image banner_mobile" style="background-image:url('<?php echo $banner_mobile; ?>')"></div>
		<div class="container">
			<h2><?php echo $banner_title;?></h2>
		</div>
	</div>
<?php } ?>