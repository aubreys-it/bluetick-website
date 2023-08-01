<?php
/**
 *
 * @package _olea
 */

get_header();

global $wp_query;

?>
<section class="blog-hero">
    <div class="container">        
        
    </div>
    <img class="blog-top-texture" src="<?php echo get_template_directory_uri(); ?>/img/blog_yellow_texture.png">
</section>

<section class="blog-content">
    <div class="container">
    	<div class="row">
    		<div class="col-lg-8 col-md-12 col-sm-12">
    			<main class="site-main" id="main">    			
					<div class="row row-eq-height post-row">
					

					<?php 
					// get the 2 case studies
					?>
					<?php if ( have_posts() ) : ?>

						<?php /* Start the Loop */ ?>

						<?php 
						$total_items = get_posts_count();
						//echo '$total_items = '.$total_items.'<br>';
						$counter = 0;
						$first_run = true;
						while ( have_posts() ) : the_post(); ?>

							<?php							

							if ($counter % 2 == 0 && $counter != 0 && $counter != 1) {
							   	echo '<div class="col-lg-6 col-md-12 col-sm-12 post-col post-col-md">';
							   	get_template_part( 'loop-templates/content', get_post_format() );
							   	echo '</div>';
							}
							else if ($counter % 3 == 0 && $counter != 0 && $counter != 1) {
							   	echo '<div class="col-lg-6 col-md-12 col-sm-12 post-col post-col-md">';
							   	get_template_part( 'loop-templates/content', get_post_format() );
							   	echo '</div>';
							   $counter = 0;
							}
							else if ($counter != 1 || $counter != 2  || $counter != 3){
								echo '<div class="col-sm-12 post-col post-col-lg">';
								get_template_part( 'loop-templates/content', get_post_format() );
								echo '</div>';
							}
							
							if ($counter == 0 && $first_run){
								$args = array(
								'post_type'      => 'case-studies',
								'orderby'        => 'date',
								'order'          => 'DESC',
								'posts_per_page' => 2
								);

								// The Query
								$the_query = new WP_Query( $args );

								// The Loop
								while ( $the_query->have_posts() ) : $the_query->the_post();
								?>

								<div class="col-md-6 col-sm-12 case-study-small">
									<?php get_template_part( 'loop-templates/content', 'case-study-small' ); ?>
								</div>

								<?php   
								endwhile;

								// Reset Post Data
								wp_reset_postdata();
								$first_run = false;
							}
							$counter++;
							?>

						<?php endwhile; ?>

					<?php else : ?>

						<?php 
                        echo '<div class="col-sm-12">';
                        get_template_part( 'loop-templates/content', 'none' ); 
                        echo '</div>';
                        ?>

					<?php endif; ?>

					
					</div>
					<?php 

    			if (  $wp_query->max_num_pages > 1 )
					echo '<div class="btn loadmore-btn load-md">Load more stories</div>';
				?>
				</main><!-- #main -->
    		</div>
    		<div class="col-lg-4 col-md-12 col-sm-12 sidebar-holder">
    			<?php get_template_part( 'global-templates/right-sidebar' ); ?>
    		</div>
    	</div>
		

	</div><!-- #primary -->
</section>

<?php get_footer(); ?>
