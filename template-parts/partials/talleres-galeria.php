<?php

$page_url=get_permalink($post);

$index = intval(get_query_var('id'));
$galeria = get_field('galeria', $post);
?>
<div class="display_detalle">
	<div class="titulo">
		Fotos
	</div>
	<div class="btn_regresar">
		<a href="<?php echo $page_url?>" class="full"></a>
		Regresar
	</div>
	<div class="contenedor_fotos">
		<div class="galeria_de_fotos jssor_box">
	    <div id="slider1_container" class="slider_container " style="position: relative; top: 0px; left: 0px; width: 1010px; height: 513px; background: #191919; overflow: hidden;">			        
	        <!-- Slides Container -->
	        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1010px; height: 513px; overflow: hidden;">
		<?php
		if($galeria){
		foreach($galeria as $foto){
			$imagen = $foto['imagen'];
			$thumb = $foto['thumb'];
		?>
	            <div>
	                <img u="image" src="<?php echo $imagen?>" />
	                <img u="thumb" src="<?php echo $thumb?>" />
	            </div>
		<?php }
		} ?>
	        </div>
	        <!--#region Arrow Navigator Skin Begin -->	        
	        <!-- Arrow Left -->
	        <span u="arrowleft" class="jssora05l" >
	        </span>
	        <!-- Arrow Right -->
	        <span u="arrowright" class="jssora05r">
	        </span>
	        <!-- thumbnail navigator container -->
	        <div u="thumbnavigator" class="jssort01" style="left: 0px; bottom: 0px;">
	            <!-- Thumbnail Item Skin Begin -->
	            <div u="slides" style="cursor: default;">
	                <div u="prototype" class="p">
	                    <div class=w><div u="thumbnailtemplate" class="t"></div></div>
	                    <div class=c></div>
	                </div>
	            </div>
	            <!-- Thumbnail Item Skin End -->
	        </div>
	    </div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>/js/jssor.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>/js/jssor.slider.js"></script>
