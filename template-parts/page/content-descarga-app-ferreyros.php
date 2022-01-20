<?php

// echo "++++Appstore+++";

$url_app_store = get_field('url_app_store', $post); //'https://play.google.com/store/apps/details?id=pe.com.ferreyros.ferreyros'
$url_play_store = get_field('url_play_store', $post); //'https://play.google.com/store/apps/details?id=pe.com.ferreyros.ferreyros'

$imagen_app_store = get_field('imagen_app_store', $post);
$imagen_play_store = get_field('imagen_play_store', $post);


?>
<div class="caja">
	<h1><?php echo $post->post_title; ?></h1>
	<div class="texto">
		<?php echo $post->post_content; ?>
		<div class="lista_tipo_uno">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3">
					<p><a href="<?php echo $url_app_store; ?>" target="_blank"><img src="<?php echo $imagen_app_store;?>" alt="" /></a></p>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<p><a href="<?php echo $url_play_store; ?>" target="_blank"><img src="<?php echo $imagen_play_store;?>" alt="" /></a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
$(document).ready(function (){
	if(navigator.userAgent.toLowerCase().indexOf("android") > -1){
		window.location.href = '<?php echo $url_play_store; ?>';
	}
	if(navigator.userAgent.toLowerCase().indexOf("iphone") > -1){
		window.location.href = '<?php echo $url_app_store; ?>';
	}
});
</script>