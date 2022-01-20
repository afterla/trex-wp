<?php
/**
 * Template Name: Plantilla Interna - Local
 *
 * @package WordPress
 */

$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$parent_content=$parent->post_content;
$page_title = $post->post_title;

$sucursales = get_field('sucursal', $post);
$sucursal = count($sucursales)>0? $sucursales[0]: null;

//the_post();
get_header();
?>
<section>
<?php get_template_part( 'template-parts/navigation/banner', 'top' ); ?>

<div class="container">
<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja">
		<h1><?php echo $parent_title; ?></h1>
		<div class="texto">
			<?php echo $parent_content; ?>
		</div>
		<div class="locales_wrapper">
			<div class="row padd-8">
				<div class="col-md-4">
					<div class="detalle_local">
						<div class="titulo">
							<?php echo $page_title; ?>
						</div>
						<div class="caja_detalle">

						<?php if(count($sucursales)>1){ ?>
							<div class="campo_select">
								<select name="sucursal" id="sucursal">
									<option value="">Seleccione Sede</option>
								<?php foreach($sucursales as $item){
									if(isset($location) && $location=="$item[lat];$item[lng]"){
										$sucursal=$item;
									}
									?>
									<option value="<?php echo $item['lat']; ?>;<?php echo $item['lng']; ?>"><?php echo $item['titulo']; ?></option>
								<?php } ?>
								</select>
							</div>
						<?php } ?>

						<?php if(isset($sucursal)){ ?>
							<ul class="direcciones">
								<li>
									<span><?php echo $sucursal['titulo'];?></span>
									<?php echo $sucursal['descripcion'];?>
								</li>
							</ul>
						<?php } ?>

							<div class="btn_volver">
								<a href="<?php echo get_permalink($parent); ?>" class="full"></a>
								Regresar
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="mapa">
						<div id="ubication_map"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script>
 	$(function(){
 		$('.detalle_local').jqTransform({imgPath:'jqtransformplugin/img/'});

 		$('#sucursal').change(function(){
 			var s=$('#sucursal').val();
 			if(s!=''){
 				location.href='<?php echo get_permalink($post); ?>?location='+s;
 			}

 		});

	<?php if(isset($sucursal)){ ?>
		var uluru = {lat: <?php echo $sucursal['lat']; ?>, lng: <?php echo $sucursal['lng']; ?>};
		var map = new google.maps.Map(document.getElementById('ubication_map'), {
			zoom: 16,
			center: uluru
		});
		var marker = new google.maps.Marker({
			position: uluru,
			map: map
		});
	<?php } ?>

 	});
</script>


</div>
</section>

<?php get_footer();
