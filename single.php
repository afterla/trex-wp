<?php
/**
 *
 * @package WordPress
 */


$parent = get_post( $post->post_parent );

$parent_title=$parent->post_title;
$post_title = $post->post_title;
$post_content = $post->post_content;
$post_type = $post->post_type;

//the_post();
get_header();

get_template_part( 'template-parts/post/content', $post_type );

get_footer();
