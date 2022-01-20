<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ferreyros
 */

$widgets = get_field('footer_widgets', 'option');
$accesos = get_field('footer_accesos', 'option');
$redes = get_field('footer_redes', 'option');
$enlaces = get_field('footer_enlaces', 'option');
$atencion= get_field('footer_atencion', 'option');
?>

    <footer>


<div class="footer_yellow">
    <div class="container">
        <div class="row padd-10">
        <?php if($accesos){ ?>
            <?php
            foreach ($accesos as $item) {
                $tit = $item['titulo'];
                $res = $item['resumen'];
                $img = $item['icono'];
                $url = $item['url'];
                $tar = get_target($url);
            ?>
            <div class="col-md-4 col-lg-3 padd-10">
                <div class="foot_btn">
                    <a href="<?php echo $url; ?>" target="<?php echo $tar; ?>" class="full">
                    <div class="ico">
                        <img src="<?php echo $img; ?>" alt="<?php echo $tit; ?>">
                    </div>
                    <span>
                        <?php echo $tit; ?>
                    </span>
                    </a>
                </div>
            </div>
            <?php
                }
            ?>
        <?php } ?>

        <?php if($redes){ ?>
            <div class="col-lg-3 padd-10">
                <div class="container">
                    <div class="row redes_sociales">
            <?php
            foreach ($redes as $item) {
                $tit = $item['titulo'];
                $res = $item['resumen'];
                $img = $item['icono'];
                $url = $item['url'];
                $tar = get_target($url);
            ?>
                        <div class="col-3">
                            <div class="ico">
                                <a href="<?php echo $url; ?>" target="_blank" target="<?php echo $tar; ?>"><img src="<?php echo $img; ?>" alt="<?php echo $tit; ?>"></a>
                            </div>
                        </div>
            <?php
                }
            ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        </div>
    </div>
</div>
<div class="footer_black">
    <div class="container trex__footer_container">

        <div>
            <?php the_field('footer_atencion', 'option'); ?>
        </div>
        <div class="trex__footer_logo">
            <h3>Una empresa del grupo</h3>
            <?php 
                $image = get_field('logo_empresa', 'option');
                if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
        </div>

    </div>
</div>
<div class="pie">
    <div class="container">
       <?php the_field('footer_copy', 'option'); ?>
    </div>
</div>
        </footer> 
    </div>
<?php
    wp_footer();
?>
 </body>
 </html>
