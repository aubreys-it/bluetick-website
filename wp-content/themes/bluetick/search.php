<?php
/**
 * The template for displaying search results pages.
 *
 * @package _olea
 */

get_header();

?>

<section class="page-content">
    <div class="container">
        <main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php
				$day_check = '';
				while (have_posts()) : the_post();
				  $day = get_the_date('j');
				  if ($day != $day_check) {
				    if ($day_check != '') {
				      echo '</ul>'; // close the list here
				    }
				    echo '<h2 class="day-title">'.get_the_date() . '</h2><ul class="posts-list">';
				  }
				?>
				<li>
					<?php
					$categories = get_the_category();
					$content_type = $categories[0]->slug;
		            get_template_part( 'loop-templates/content', $content_type );
		            ?>	
				</li>
				<?php
				$day_check = $day;
				endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-templates/content', 'none' ); ?>

			<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php _olea_pagination(); ?>
    </div>
</section>

<?php get_footer(); ?>
