<?php
$parent_id = get_query_var( 'parent', null );
$page_url = get_permalink($post).'?parent='.$parent_id;

$index = intval(get_query_var('id'));
$videos  = get_field('video360', $post);
?>

<div class="contenedor seccion_principal">
	<div class="row padd-8">
		<div class="col-md-3">
			<?php get_template_part( 'template-parts/partials/producto', 'resumen' );?>
		</div>
	<?php if(count($videos)>0){?>
		<div class="col-md-9">
			<div class="galeria_de_videos">
				<div class="close">
					<a href="<?php echo $page_url?>#ancla" class="full"></a>
				</div>
				<div id="slider1_container" class="slider_container jssor_box" style="position: relative; top: 0px; left: 0px; width: 527px; height: 300px; background: #191919; overflow: hidden;">
					<!-- Slides Container -->
					<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 527px; height: 300px; overflow: hidden;">
					<?php
					$k=0;
					//var_dump($videos);
					foreach($videos as $video){
						$name = $video['name'];
						$url = $video['url'];
					?>
						<div class="video_slider">
							<iframe u="image" width="527" height="295" src="<?php echo $url;?>" frameborder="0" scrolling="no"></iframe>
						</div>
					<?php }?>
					</div>
					<span u="arrowleft" class="jssora05l" >
					</span>
					<span u="arrowright" class="jssora05r">
					</span>
					<div u="thumbnavigator" class="jssort01" style="left: 0px; bottom: 0px;">
						<div u="slides" style="cursor: default;">
							<div u="prototype" class="p">
								<div class=w><div u="thumbnailtemplate" class="t"></div></div>
								<div class=c></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }?>
	</div>
</div>

<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>/js/jssor.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>/js/jssor.slider.js"></script>