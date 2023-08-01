<?php
/**
 * Template Name: Front
 *
 * @package _olea
 */

get_header();
?>
<section class="splash-wrapper">
    <div class="container">
        <div class="row">
            
            <div class="col-md-4 home-col-2 order-sm-1 order-md-2">
                <div class="tagline">
                    <?php the_field( 'tagline' ); ?>
                </div>
                <div class="offerings">
                    <?php the_field( 'what_we_have' ); ?>
                </div>
                <!-- <a href="<?php the_field( 'menu' ); ?>" target="_blank" class="view-menu-btn"><img src="<?php echo get_template_directory_uri(); ?>/img/view_menu.png"></a> -->		<a href="https://blueticktavern.com/wp-content/uploads/2022/03/bluetick_food_menu.pdf" target="_blank" class="view-menu-btn"><img src="<?php echo get_template_directory_uri(); ?>/img/view_menu.png"></a>	
                <div class="address-wrapper">
                    <?php the_field( 'address' ); ?>
                </div><br />
                <a href="https://goo.gl/maps/oDi4xifYfvRo3sDP6" class="directions-btn" target="_blank"></a>
            </div>
            <div class="col-md-4 home-col-3 order-sm-2 order-md-3">
                <div class="hours-wrapper">
                    <span>OPEN</span>
                    <?php the_field( 'hours' ); ?>
                </div>
            </div>
            <div class="col-md-4 home-col-1 order-sm-3 order-md-1">
                 <a class="order-online-btn chownow-order-online" target="_blank"><img class="dog-gif" src="<?php echo get_template_directory_uri(); ?>/img/bluetick_button_order-online_01.gif"></a>
            </div>
        </div>
        <a href="https://blueticktavern.com/wp-content/uploads/2021/11/bluetick_banquet.pdf" class="banquets-btn" target="_blank"></a>
        <a href="tel:865-983-0808" class="telephone-number"><img alt="865-983-0808" src="<?php echo get_template_directory_uri(); ?>/img/telephone_number.png"></a>
        <div class="all-roads-lead-to"><img alt="865-938-0808" src="<?php echo get_template_directory_uri(); ?>/img/all_roads_lead_to.png"></div>        

    </div>

    <div class="home-slider-wrapper">
        <div class="home-slider">
            <?php if ( have_rows( 'slider' ) ) : ?>
              <?php while ( have_rows( 'slider' ) ) : the_row(); ?>
                <?php 
                $photo = get_sub_field( 'photo' );
                $image = wp_get_attachment_image_src( $photo, 'slide-photo' );
                ?>
                <?php if ( $photo ) { ?>
                  
                  <div class="home-slide" style="background-image:url()"><img src="<?php echo $image[0]; ?>"></div>
                <?php } ?>
                
              <?php endwhile; ?>
            <?php else : ?>
              <?php // no rows found ?>
            <?php endif; ?>              
        </div>
         <ul class="gallery-arrows">
            <li class="gallery-prev"></li>
            <li class="gallery-next"></li>
        </ul>
    </div>
</section>

<?php get_footer(); ?>
