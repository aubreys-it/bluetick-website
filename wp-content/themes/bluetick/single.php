<?php
/**
 * The template for displaying all single posts.
 *
 * @package _olea
 */

get_header();
?>

<section class="blog-single-content">
    <div class="container">
        <?php if ( have_posts() ) : ?>

            <?php 
            while ( have_posts() ) : the_post(); ?>
           
        <div class="row blog-single-top align-items-center">
            <div class="col-md-7">
                <?php echo get_the_post_thumbnail( $post->ID, 'post-image-md' ); ?>
            </div>
            <div class="col-md-5">
                <div class="post-single-top-right-content">
                    <div class="entry-meta">
                        <?php _olea_posted_on(); ?>
                        <div class="entry-meta-sep">•</div>
                        <?php echo do_shortcode('[rt_reading_time label="" postfix="mins read" postfix_singular="min read"]'); ?>
                    </div><!-- .entry-meta -->

                    <?php the_title( sprintf( '<h2 class="entry-title">', esc_url( get_permalink() ) ),
            '</h2>' ); ?>

                    <?php
                    $author_id = $post->post_author;
                    $author_first_name = get_the_author_meta('first_name', $author_id );
                    $author_last_name = get_the_author_meta('last_name', $author_id );
                    $author_nickname = get_the_author_meta('nickname', $author_id );
                    $post_date = get_the_date( 'M. j, Y' ); 
                    ?>
                    <div class="author-panel small">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>author/<?php echo $author_nickname; ?>">
                            <div class="avatar-wrapper">
                                <img src="<?php echo esc_url( get_avatar_url( $author_id ) ); ?>" />
                            </div>
                            <div class="author-content-wrapper">
                                <h5><?php echo $author_first_name.' '.$author_last_name; ?></h5>
                                <div class="posted-on-date">posted on <?php echo $post_date; ?></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12">
                <?php get_template_part( 'loop-templates/content', 'single' ); ?>

                <div class="single-meta-box">
                    <div class="single-meta-box-top">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>Author</h4>
                                <div class="author-panel small">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>author/<?php echo $author_nickname; ?>">
                                        <img src="<?php echo esc_url( get_avatar_url( $author_id ) ); ?>" />
                                        <div class="author-content-wrapper">
                                            <h5><?php echo $author_first_name.' '.$author_last_name; ?></h5>
                                            <div class="posted-on-date">posted on <?php echo $post_date; ?></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4>Categories</h4>
                                <?php _olea_posted_on(); ?>
                            </div>
                        </div>
                    </div>
                    <?php
if (isset($_GET['utm_source'])) {
    $utm_source = $_GET['utm_source'];
} else {
    $utm_source = "";
}

if (isset($_GET['utm_medium'])) {
    $utm_medium = $_GET['utm_medium'];
} else {
    $utm_medium = "";
}

if (isset($_GET['utm_campaign'])) {
    $utm_campaign = $_GET['utm_campaign'];
} else {
    $utm_campaign = "";
}

if (isset($_GET['utm_term'])) {
    $utm_term = $_GET['utm_term'];
} else {
    $utm_term = "";
}

if (isset($_GET['utm_content'])) {
    $utm_content = $_GET['utm_content'];
} else {
    $utm_content = "";
}

?>
                    <div class="single-meta-box-bottom">
                        <div class="sidebar-newsletter">
                        <form action="https://go.get_olea.com/l/700933/2019-02-23/7qt" method="post">
                            <input type="hidden" name="utm_source" value="<?php echo $utm_source; ?>">
                            <input type="hidden" name="utm_medium" value="<?php echo $utm_medium; ?>">
                            <input type="hidden" name="utm_campaign" value="<?php echo $utm_campaign; ?>">
                            <input type="hidden" name="utm_term" value="<?php echo $utm_term; ?>">
                            <input type="hidden" name="utm_content" value="<?php echo $utm_content; ?>">
                            <div class="sidebar-newsletter-content">
                              <div class="sidebar-newsletter-left">
                                <input type="text" class="form-control required email" required="true" name="email" id="email" placeholder="Email for weekly newsletter">
                              </div>
                              <div class="sidebar-newsletter-right">
                                  <button type="submit" class="btn btn-primary">Subscribe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endwhile; ?>

        <?php endif; ?>

    </div><!-- #primary -->
</section>

<img class="footer-top-texture related-stories-texture" src="<?php echo get_template_directory_uri(); ?>/img/footer_top_texture.png">
<section class="related-stories">
    <div class="container">
        <h1>Related Stories</h1>
        <div class="row">
            <?php
// Default arguments
$args = array(
    'posts_per_page' => 3, // How many items to display
    'post__not_in'   => array( get_the_ID() ), // Exclude current post
    'no_found_rows'  => true, // We don't ned pagination so this speeds up the query
);

// Check for current post category and add tax_query to the query arguments
$cats = wp_get_post_terms( get_the_ID(), 'category' ); 
$cats_ids = array();  
foreach( $cats as $wpex_related_cat ) {
    $cats_ids[] = $wpex_related_cat->term_id; 
}
if ( ! empty( $cats_ids ) ) {
    $args['category__in'] = $cats_ids;
}

// Query posts
$wpex_query = new wp_query( $args );

// Loop through posts
foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>

    <div class="col-lg-4 col-md-12 col-sm-12 med-panel post-col post-col-md""> 
        <?php get_template_part( 'loop-templates/content', get_post_format() ); ?>
    </div>

<?php
// End loop
endforeach;

// Reset post data
wp_reset_postdata(); ?>

        </div>
    </div>
    
</section>


<?php get_footer(); ?>
