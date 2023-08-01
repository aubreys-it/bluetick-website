<?php
/**
 * The template for displaying the author pages.
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package _olea
 */

get_header();

?>

<?php
$author_id = $post->post_author;
$author_first_name = get_the_author_meta('first_name', $author_id );
$author_last_name = get_the_author_meta('last_name', $author_id );
$author_nickname = get_the_author_meta('nickname', $author_id );
?>

<section class="blog-hero">
    <div class="container">        
        
    </div>
    <img class="blog-top-texture" src="<?php echo get_template_directory_uri(); ?>/img/blog_yellow_texture.png">
</section>

<section class="blog-content category-page">
    <div class="container">
    	<div class="row">
    		<div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2">
    		<div class="author-panel big">
    			<div class="avatar-wrapper">
                <img src="<?php echo esc_url( get_avatar_url( $author_id ) ); ?>" />
            </div>
                <div class="author-content-wrapper">
                    <h5><?php echo $author_first_name.' '.$author_last_name; ?></h5>
                    <div class="author-bio">
                    	<?php
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
                    </div>
                </div>
            </div>
        </div>
			
		</div><!-- .page-header -->
    	<div class="row">
    		<div class="col-sm-12">
    			<main class="site-main" id="main">    			
					<div class="row row-eq-height post-row">
					

					<?php 
					// get the 2 case studies
					?>
					<?php if ( have_posts() ) : ?>

						<?php 
						$total_items = get_posts_count();
						//echo '$total_items = '.$total_items.'<br>';
						$counter = 0;
						$first_run = true;
						while ( have_posts() ) : the_post(); ?>

							<?php							
							if ($counter == 0 && $first_run){
								echo '<div class="col-sm-12 wide-panel post-col post-col-wide">';
								get_template_part( 'loop-templates/content', 'single-wide' );
								echo '</div>';
							}
							else
							{
								echo '<div class="col-lg-4 col-md-12 med-panel post-col post-col-md">';
								get_template_part( 'loop-templates/content', get_post_format() );
								echo '</div>';
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
					echo '<div class="btn loadmore-btn load-small">Load more stories</div>';
				?>
				</main><!-- #main -->
    		</div>
    	</div>
		

	</div><!-- #primary -->
</section>

<?php get_footer(); ?>
