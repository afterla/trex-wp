<?php

$section_id=get_top_parent_id($post->ID);
$section=get_post($section_id);

if($section){
	$banner_desktop=get_field('banner_desktop', $post);
	$banner_slogan=get_field('banner_slogan', $post);
	$banner_mobile=get_field('banner_mobile', $post);
	$banner_title=get_field('banner_title', $post);
	if(!$banner_title) $banner_title = get_field('banner_title', $section);
?>
	<div class="banner banner_trabaje">
		<div class="banner_image banner_desktop" style="background-image:url('<?php echo $banner_desktop; ?>')"></div>
		<div class="banner_image banner_mobile" style="background-image:url('<?php echo $banner_mobile; ?>')"></div>

		<div class="container">	
			<div class="slogan_trabaje">
				<img src="<?php echo $banner_slogan; ?>">
			</div> 				
			<h2><?php echo $banner_title;?></h2>
		</div>
	</div>
<?php } ?>