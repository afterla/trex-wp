<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage ferreyros
 * @since 1.0
 * @version 1.0
 */

$parent_id=get_top_parent_id($post->ID);

if($parent_id!=null){
?>
	<div class="wrapper-nav-interna">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-md-3">
					<nav class="nav-interna hidden-xs">
						<?php echo custom_menu_left( $parent_id );?>
					</nav>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>
