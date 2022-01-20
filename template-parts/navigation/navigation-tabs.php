<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage ferreyros
 * @since 1.0
 * @version 1.0
 */

$menu_tabs=get_pages( array( 'child_of' => $post->post_parent, 'sort_column' => 'menu_order', 'sort_order' => 'asc' ) );
?>
<?php
if($menu_tabs){
?>
    <ul class="nav nav-tabs">
    <?php
    foreach ($menu_tabs as $tab) {
      $title = $tab->post_title;
      $permalink = get_permalink($tab->ID);
      $active = $tab->ID==$post->ID? 'active': null;
    ?>
      <li class="<?php echo $active;?>"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></li>
    <?php
      }
    ?>
    </ul>
<?php
}