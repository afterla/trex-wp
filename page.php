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

$page_template = get_page_template_slug();
if($page_template =='') $page_template = 'page-none.php';

include('templates/'.$page_template);
echo '<!-- '.$page_template.' /-->';
