<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package _olea
 */

get_header();

?>
<section class="basic-wrapper">
    <div class="container">        
        <div class="row">
            <div class="col-md-8 offset-md-2">
            	<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/content', 'page' ); ?>

					<?php endwhile; // end of the loop. ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
