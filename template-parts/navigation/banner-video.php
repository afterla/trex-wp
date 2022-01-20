<?php

	$banner_video=get_field('banner_video', $post);
	$banner_poster=get_field('banner_poster', $post);
	$banner_title=get_field('banner_title', $post);
	$banner_subtitle=get_field('banner_subtitle', $post);
	if(!$banner_title) $banner_title = $post->post_title;
?>
	<div class="banner banner_video">
		<div class="velo"></div>
	<div class="box">
		<div class="titulo">
			<?php echo $banner_title;?>
		</div>
		<div class="texto">
			<?php echo $banner_subtitle;?>
		</div>
		<div class="flecha scroller">
			<a href="#content_interna" class="full"></a>
		</div>
	</div>
	<div class="poster_fondo" style="background-image: url(<?php echo $banner_poster; ?>)"></div>
	<div class="video-container">
		<video id="video_player" preload="auto" poster="<?php echo $banner_poster; ?>" loop="true" data-setup="{}">
			<source src="<?php echo $banner_video; ?>" type="video/mp4">
		</video>
	</div>
	</div>