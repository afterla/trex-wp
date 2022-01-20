<?php

$parent_id = get_query_var( 'parent', null );

if($post->post_type!='page' && empty($parent_id)){

	$info = get_post_title_info($post);
	if(!empty($info['parent'])){

		$args = array(
		  'name'        => $info['parent'],
		  'post_type'   => 'page',
		  'post_status' => 'publish',
		  'numberposts' => 1
		);
		$posts = get_posts($args);

		if($posts) $parent_id = $posts[0]->ID;		
	}
}

$parents = !empty($parent_id)? get_top_parents( $parent_id ): get_top_parents( $post->ID );
if( !empty($parent_id) ) array_push($parents, intval($parent_id));

?>
	<div class="recram">
		/ <a href="<?php echo WEB_URL;?>">Inicio</a> / 
		<?php foreach($parents as $pid){
			$parent=get_post($pid); ?>
			<a href="<?php echo get_permalink($parent); ?>"><?php echo $parent->post_title; ?></a> / 			
		<?php } ?>
		<a href="<?php echo get_permalink($post); ?>" class="activo"><?php echo $post->post_title; ?></a>
	</div>
<?php
?>