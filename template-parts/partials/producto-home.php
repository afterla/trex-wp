<?php
$parent_id = get_query_var( 'parent', null );
$page_url = get_permalink($post).'?parent='.$parent_id;

$product = $post->post_title;
$imagen = get_field('imagen', $post);
if (empty($imagen)) $imagen = get_field('url_imagen', $post);

$gallery = get_field('gallery', $post);

$videos = get_field('video', $post);
$videos360 = get_field('video360', $post);

?>
<div class="contenedor seccion_principal">
	<div class="row padd-8">
		<div class="col-md-3">
			<?php get_template_part( 'template-parts/partials/producto', 'resumen' );?>
		</div>
		<div class="col-md-6">
		<?php
			if($gallery){
		?>
			<div class="galeria_de_fotos">
				<div id="slider1_container" class="slider_container jssor_box" style="position: relative; top: 0px; left: 0px; width: 565px; height: 380px; background: #191919; overflow: hidden;">			        
					<!-- Slides Container -->
					<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 565px; height: 380px; overflow: hidden;">
					<?php
						foreach($gallery as $item){
							$imagen_ = $item['imagen']? $item['imagen']: $item['url'];
					?>
						<div>
							<img u="image" src="<?php echo $imagen_; ?>" />
							<img u="thumb" src="<?php echo $imagen_; ?>?$cc-s$" />
						</div>
					<?php
						}
					?>
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
		<?php
			}
		?>
		</div>
		<div class="col-md-3">
		<aside>
		<?php if($videos>0){ ?>
			<div class="btn_lateral video">
				<a href="<?php echo $page_url;?>&view=videos#ancla" class="full"></a>
				<img src="<?php echo $imagen; ?>?$cc-s$">
				<div class="velo">
					<img src="<?php echo TEMPLATE_URL; ?>/images/ico-play.png">
				</div>
			</div>
		<?php } ?>
		<?php if($videos360>0){ ?>
			<div class="btn_lateral tressesenta">
				<a href="<?php echo $page_url;?>&view=videos360#ancla" class="full"></a>
				<img src="<?php echo $imagen; ?>?$cc-s$">
				<div class="velo">
					<img src="<?php echo TEMPLATE_URL; ?>/images/ico-360.png">
				</div>
			</div>
		<?php } ?>
		</aside>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>/js/jssor.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>/js/jssor.slider.js"></script>