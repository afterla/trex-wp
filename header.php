<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WordPress
 */

$wrapper = is_home()? 'wrapper_home': 'wrapper_interna';
$ogimage = $post->post_type=='promocion'? get_field('imagen', $post): TEMPLATE_URL.'/images/ferreyros-facebook.jpg';
$ogdescr = is_home()? get_bloginfo('description'): preg_replace('/\s+/', ' ', strip_tags($post->post_content));
?>
 <!DOCTYPE html>
 <html lang="es">
 <head>
 	<meta charset="utf-8">
 	<title><?php wp_title('|', true, bloginfo('name'))?></title>

	<meta property="og:title" content="<?php wp_title('|', true, bloginfo('name'))?>"/>
	<meta property="og:site_name" content="<?php  bloginfo('name'); ?>"/>
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?php echo $ogimage; ?>" />
	<meta property="og:description" content="<?php echo $ogdescr; ?>" />

<?php if(is_home()){ ?>
	<!--CHATBOT HEAD-->
	<!--CHATBOT HEAD END-->
<?php } ?>
 	
 	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<link rel="shortcut icon" href="<?php echo TEMPLATE_URL;?>/images/favicon.ico" type="image/x-icon" />
 	<link rel="stylesheet" href="<?php echo TEMPLATE_URL;?>/css/main.css" media="screen">
 	<link rel="stylesheet" href="<?php echo TEMPLATE_URL;?>/css/bootstrap.min.css" media="screen">
 	<link rel="stylesheet" href="<?php echo TEMPLATE_URL;?>/css/bootstrap-grid.css" media="screen">
	 <link rel="stylesheet" href="<?php echo TEMPLATE_URL;?>/css/styles.css" media="screen">

 	<script src="<?php echo TEMPLATE_URL;?>/js/jquery-1.11.3.min.js"></script>
 	<script src="<?php echo TEMPLATE_URL;?>/js/popper.min.js"></script>
 	<script src="<?php echo TEMPLATE_URL;?>/js/jquery.matchHeight.js"></script>
 	<script src="<?php echo TEMPLATE_URL;?>/js/bootstrap.min.js"></script>
 	<script src="<?php echo TEMPLATE_URL;?>/js/libs/loader/Pxloader.js"></script>
 	<script src="<?php echo TEMPLATE_URL;?>/js/libs/loader/PxloaderImage.js"></script>
 	<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/TweenMax.min.js"></script>

	<script src="<?php echo TEMPLATE_URL;?>/js/owl.carousel.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBictaMX6RS7Re_qdnxDa21-gWVAFkINik"></script>

 	<script src="<?php echo TEMPLATE_URL;?>/js/funciones.js"></script>
 	<script src="<?php echo TEMPLATE_URL;?>/js/jquery.jqtransform.js"></script>
 	<script src="<?php echo TEMPLATE_URL;?>/js/jquery.bxslider.min.js"></script>
 	<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/source/jquery.fancybox.pack.js?v=2.1.5"></script>
 	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/js/source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<link rel='stylesheet' id='contact-form-7-css'  href='<?php echo WEB_URL;?>/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=5.0.1' type='text/css' media='all' />
	<?php //wp_head(); ?>

<?php if(is_home()){ ?>
	<script src="https://www.ferreycorp.com.pe/burbuja/assets/js/burbuja.js"></script>
<?php } ?>

	<script>
		var TEMPLATE_URL='<?php echo TEMPLATE_URL;?>';
		var WEB_URL='<?php echo WEB_URL;?>';
	</script>
 </head>
 <body <?php body_class(); ?>> 	

 	<?php if(is_home()) echo '<div id="loader"></div>';?>
 	<div class="wrapper <?php echo $wrapper;?>">
<?php
    get_template_part( 'template-parts/navigation/navigation', 'top' );
