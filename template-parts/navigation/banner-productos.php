<?php

$args = array(
  'name'        => 'productos',
  'post_type'   => 'page',
  'post_status' => 'publish',
  'numberposts' => 1
);
$section = get_posts($args);

if($section){
	$banner_desktop=get_field('banner_desktop', $section[0]);
	$banner_mobile=get_field('banner_mobile', $section[0]);
	$banner_title=get_field('banner_title', $section[0]);
	if(!$banner_title) $banner_title = $section[0]->post_title;
?>
	<div class="banner">
		<div class="banner_image banner_desktop" style="background-image:url('<?php echo $banner_desktop; ?>')"></div>
		<div class="banner_image banner_mobile" style="background-image:url('<?php echo $banner_mobile; ?>')"></div>
		<div class="container">
			<h2><?php echo $banner_title;?></h2>
		</div>
	</div>
<?php } ?>