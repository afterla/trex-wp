<?php
    /* Template Name: Home */
    get_header();
?>
    <?php if ( have_posts()) : while ( have_posts()) : the_post(); ?>
		<h1>Hola mundo!</h1>
    <?php endwhile; endif; ?>
<?php
    get_footer();
?>
