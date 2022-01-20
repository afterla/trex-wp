<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ferreyros
 * @since 1.0
 * @version 1.0
 */

//the_post();
get_header();

?>
<section class="seccion_nosotros">

<div class="container">

	<div class="caja">

		<h1>404 - Página no encontrada</h1>
		<h6>¿Qué puede haber ocurrido?</h6>

		<ul>
			<li>- La página fue movida.</li>
			<li>- La página ya no existe.</li>
			<li>- La dirección que ingresaste en la barra de direcciones no es correcta.</li>
		</ul>

		<p>Para encontrar lo que deseas, te proponemos:</p>

		<ul>
			<li><a href="<?php echo WEB_URL; ?>" style="color: #fbbd00;">Ir a la página de inicio</a></li>
			<li><a href="<?php echo WEB_URL; ?>/escribanos/" style="color: #fbbd00;">Contáctate con nosotros</a></li>
		</ul>

	</div>

</div>
</section>
<?php

get_footer();
