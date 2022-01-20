<?php
$parent_id = get_query_var( 'parent', null );
$page_url = get_permalink($post).'?parent='.$parent_id;

$product = $post->post_title;
$imagen = get_field('imagen', $post);
if (empty($imagen)) $imagen = get_field('url_imagen', $post);

$gallery = get_field('gallery', $post);

$videos = get_field('video', $post);
$videos360 = get_field('video360', $post);

$specs = get_field('specification', $post);

?>
<div class="contenedor seccion_principal trex__view_product">
	<div class="row padd-8">
		<div class="col-md-5">
			<?php get_template_part( 'template-parts/partials/producto', 'resumen' );?>
			<div class="trex__view_product_disponible">
				<h3>DISPONIBLE EN: </h3>
				<div>
					<?php
					if ( have_rows('paises_disponibilidad') ) {
					while ( have_rows('paises_disponibilidad') ) {
						the_row();
						$slide_photo = get_sub_field('bandera');
						if ( !empty($slide_photo) ) {
					?>
					<img src="<?php echo $slide_photo['url']; ?>" alt="<?php echo $slide_photo['alt']; ?>" />
					<?php
						}
					}
					}
					?>
				</div>
			</div>
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
		<!--
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
		-->
	</div>
</div>

<div class="trex__view_product_ficha">
	
	<h2>
		FICHA TECNICA <?php the_title(); ?>
	</h2>
	<div class="contenedor seccion_informacion">
		<ul class="acordion">
	<?php
		foreach($specs as $spec){
			$details =$spec['detail'];
			$category=$spec['category'];

			if($details){
	?>
			<li>
				<div class="titulo"><?php echo $category; ?></div>
				<div class="contenido">
					<table cellspacing="0" cellpadding="0" border="0" align="center">
			<?php
				foreach($details as $item){
			?>
					<tr>
						<td><?php echo $item['name']; ?></td>
						<td><?php echo $item['value']; ?></td>
					</tr>
			<?php
				}
			?>
					</table>
				</div>
			</li>
		<?php
				}
			}
		?>
		</ul>
	</div>

</div>

<div class="trex__view_product_cotizador">
	<?php
	global $wpdb;

	$model_id = get_query_var( 'id', null );
	$parent_id = get_query_var( 'parent', null );
	$PROMO = get_query_var( 'promo', null );

	$utm_campaign = get_query_var( 'utm_campaign', null );
	$utm_source = get_query_var( 'utm_source', null );
	$utm_medium = get_query_var( 'utm_medium', null );
	$utm_content = get_query_var( 'utm_content', null );

	if(!empty($model_id) && !empty($parent_id)){
		$product = get_post($model_id);
		$marcas = get_the_terms($product, 'marca');
		$parents = get_top_parents( $parent_id );
		$MODALIDAD = $parents[1];
		$FAMILIA = count($parents)>3? $parents[3]: $parents[2];
		if(count($marcas)>0) $MARCA = $marcas[0]->term_id;
		$MODELO = $model_id;
	}
	?>
		<div class="caja">
			<h2>Cotizador</h2>

			<div class="formulario_cotizador">
					<?php echo do_shortcode( '[contact-form-7 id="2012" title="Cotizador Ferreyros"]' ); ?>
			</div>
		</div>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script src="<?php echo TEMPLATE_URL?>/js/jquery.alphanumeric.js"></script>
	<script src="<?php echo TEMPLATE_URL; ?>/js/cotizador.js"></script>
	<script>
	<?php
	if(isset($MODALIDAD)) echo "var MODALIDAD = '$MODALIDAD';\n";
	if(isset($MARCA)) echo "var MARCA = '$MARCA';\n";
	if(isset($FAMILIA)) echo "var FAMILIA = '$FAMILIA';\n";
	if(isset($MODELO)) echo "var MODELO = '$MODELO';\n";
	if(isset($PROMO)) echo "var PROMO = '$PROMO';\n";

	if(isset($utm_campaign)) echo "var utm_campaign = '$utm_campaign';\n";
	if(isset($utm_source)) echo "var utm_source = '$utm_source';\n";
	if(isset($utm_medium)) echo "var utm_medium = '$utm_medium';\n";
	if(isset($utm_content)) echo "var utm_content = '$utm_content';\n";
	?>
	$(document).ready(function() {
		$('.campo_select, .acepto').jqTransform({imgPath:'jqtransformplugin/img/'});
		$('input[name=Nombre],input[name=Apellido],input[name=Cargo]').alpha({allow:" "});
		$('input[name=Telefono]').numeric({allow:".-/* "});
		$('input[name=RUC]').numeric({allow:""});
		$('select[name=Modelo]').select2();
		
		$('.wpcf7-form').submit(function(e){
			if($('#dd_modalidad').is(':visible')) $('input[name=Modalidad_Nombre]').val($('select[name=Modalidad] option:selected').text());
			if($('#dd_marca').is(':visible')) $('input[name=Marca_Nombre]').val($('select[name=Marca] option:selected').text());
			if($('#dd_familia').is(':visible')) $('input[name=Familia_Nombre]').val($('select[name=Familia] option:selected').text());
			if($('#dd_modelo').is(':visible')) $('input[name=Modelo_Nombre]').val($('select[name=Modelo] option:selected').text());
			if($('#dd_promo').is(':visible')) $('input[name=Promocion_Nombre]').val($('select[name=Promocion] option:selected').text());
		});
		
	});
	</script>
	<script>
	<?php
	//Get last id
	$data_id = $wpdb->get_var('SELECT MAX(id) as data_id FROM wp_cf7_vdata');
	?>
	$(document).ready(function() {
	if ($('.wpcf7-mail-sent-ok').length) {
		location = '<?php echo WEB_URL.'/cotizador/gracias?'.$data_id;?>';
	}
	});
	</script>
</div>

<div class="trex__view_product_relacionados">
	<h2>PRODUCTOS RELACIONADOS</h2>
	<div>
		
	</div>
</div>

<div class="trex__view_product_servicios">
	<h2>SERVICIOS RELACIONADOS</h2>
	<div class="trex__view_product_servicios-cont">
		
			<?php
			if ( have_rows('servicios_relacionados') ) {
				while ( have_rows('servicios_relacionados') ) {
					the_row();
					$icon = get_sub_field('icono');
					if ( !empty($icon) ) {
					?>
					<div>
						<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />
						<?php the_sub_field('texto_service'); ?>
					</div>
					<?php
					}
				}
			}
			?>
			
		
	</div>
</div>




<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>/js/jssor.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>/js/jssor.slider.js"></script>