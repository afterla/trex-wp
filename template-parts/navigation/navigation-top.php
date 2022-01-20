<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage ferreyros
 * @since 1.0
 * @version 1.0
 */

$buscador= get_field('header_buscador', 'option');
$atencion= get_field('header_atencion', 'option');
?>
    <header>
      <div class="container" id="header_container">
        <div class="logo">
          <a href="<?php echo WEB_URL;?>">
            <img src="<?php echo TEMPLATE_URL;?>/images/logo.svg" alt="Ferreyros">
          </a>          
        </div>
        <div class="box_topper">
          <nav>

            <?php  echo custom_menu_main(); ?>

          </nav>
        </div>

        <div class="barra_header">
          
        <?php  echo custom_menu_header(); ?>

        <?php if($atencion){ ?>
          <div class="atencion">
            Atención al Cliente
            <?php echo $atencion; ?>
          </div>
        <?php } ?>

        <?php if($buscador){ ?>
          <div class="buscador">
            <form name="search" method="get" action="<?php echo WEB_URL;?>">
              <input type="text" name="s">
              <div class="lupa" onclick="document.forms['search'].submit();"></div>
            </form>
          </div>
        <?php } ?>

        </div>
      </div>
    </header>
    <div class="menu_mobile">
            <div class="logo">
        <a href="<?php echo WEB_URL?>">
          <img src="<?php echo TEMPLATE_URL;?>/images/logo.svg" alt="Ferreyros">
        </a>          
      </div>
      <div class="sanguche">
        <div class="lines"></div>
        <div class="lines"></div>
        <div class="lines"></div>
      </div>
      <div class="mobile_tools">        
        <div class="btn_close">
          <img src="<?php echo TEMPLATE_URL;?>/images/btn_close_menu.svg" alt="Ferreyros">
        </div>
      </div>
    </div>
