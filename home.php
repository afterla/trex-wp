<?php
/**
 *
 * @package WordPress
 */

//wp_enqueue_script( 'script', TEMPLATE_URL.'/js/slider.js' );

$banners = get_field('home_banners', 'option');
$widgets = get_field('home_widgets', 'option');
$layers = array();

get_header();

?>
        <section>
        <?php if($banners){?>
            <div class="banner">
                <ul class="slider">
                <?php foreach($banners as $item){
                    $tit = $item['titulo'];
                    $sub = $item['subtitulo'];
                    $img = $item['imagen'];
                    $img_= $item['imagen_mobile'];
                    $url = $item['url'];
                    $tar = get_target($url);
                ?>
                    <li>                        
                        <div class="banner_image banner_desktop" style="background-image:url('<?php echo $img; ?>')"></div>
                        <div class="banner_image banner_mobile" style="background-image:url('<?php echo $img_; ?>')"></div>
                        <div class="container">
                            <h2>
                                <?php echo $tit; ?>
                            </h2>
                            <p>
                                <?php echo $sub; ?>
                            </p>
                            <div class="btn">
                                <a href="<?php echo $url; ?>" target="<?php echo $tar; ?>" class="full"></a>
                                Ver más Información
                            </div>
                        </div>
                    </li>
                <?php } ?>
                </ul>
                <div class="container">
                    <div class="solapa">
                        <a href="<?php echo WEB_URL; ?>/cotizador" class="full"></a>
                        <div class="ico">
                            <img src="<?php echo TEMPLATE_URL;?>/images/ico-solapa-home.png" alt="Ferreyros">
                        </div>
                        <span>Solicite una Cotización</span>
                    </div>
                </div>
            </div>
        <?php }?>

        <?php if($widgets){?>
            <div class="container">
                <div class="row padd-8">
            <?php foreach($widgets as $item){
                $tit = $item['titulo'];
                $res = $item['resumen'];
                $img = $item['imagen'];
                $col = $item['cols'];
                $col = $col? 'col-md-6': 'col-6 col-md-3';
                $vel = $item['inferior']? 'velo velo_bajo': 'velo';
                $url = $item['url'];
                $tar = get_target($url);
            ?>

                    <div class="<?php echo $col;?>">
                        <article>
                            <a href="<?php echo $url;?>" target="<?php echo $tar; ?>" class="full"></a>
                            <img src="<?php echo $img;?>" alt="<?php echo $tit; ?>">
                            <div class="<?php echo $vel;?>">
                                <h3><span><?php echo $tit; ?></span></h3>
                                <div class="texto">
                                    <?php echo $res; ?>
                                </div>
                            </div>
                        </article>
                    </div>

                <?php } ?>
                </div>
            </div>
        <?php } ?>

        </section>

<?php get_footer(); ?>
