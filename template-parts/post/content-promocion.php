<?php
/**
 *
 * @package WordPress
 */


$post_title = $post->post_title;
$post_content = $post->post_content;
$estilos_css = get_field('estilos_css', $post);
$boton_cotizar = get_field('boton_cotizar', $post);

//$post_content = str_replace('images/', TEMPLATE_URL.'/images/', $post_content);
//$estilos_css = str_replace('images/', TEMPLATE_URL.'/images/', $estilos_css);

$utm_campaign = get_query_var( 'utm_campaign', null );
$utm_source = get_query_var( 'utm_source', null );
$utm_medium = get_query_var( 'utm_medium', null );
$utm_content = get_query_var( 'utm_content', null );
$params = !empty($utm_campaign)? "&utm_campaign=$utm_campaign&utm_source=$utm_source&utm_medium=$utm_medium&utm_content=$utm_content": null;
$notcall= !$boton_cotizar? " notcall": null;
?>
<section class="seccion_promociones">

<?php get_template_part( 'template-parts/navigation/banner', 'promociones' ); ?>

  <div class="container">
	<?php get_template_part( 'template-parts/navigation/navigation', 'breadcrumb' ); ?>

	<div class="caja">
		<h3>Promociones</h3>
		<h1><?php echo $post_title; ?></h1>
		<div class="row promociones_interna padd-8<?php echo $notcall?>">
		  <div class="col-md-12">
			<?php echo $post_content; ?>
		  </div>
		</div>
	<?php if($boton_cotizar){?>
		<div class="btn_cotiza">
			<a href="<?php echo WEB_URL ?>/cotizador?promo=<?php echo $post->ID ?><?php echo $params; ?>" class="full"></a>Cotiza Aquí
		</div>
	<?php }?>
	</div>

  </div>
</section>
<style type="text/css" media="screen">
<?php echo $estilos_css; ?>
</style>