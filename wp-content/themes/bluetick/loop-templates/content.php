<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package _olea
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php
	$permalink = get_permalink();
	?>
	<a href="<?php echo $permalink; ?>" >		
		<div class="post-bg-image" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post->ID, 'post-image-lg' ); ?>)"></div>
	</a>

	<div class="post-content-wrapper">

		<header class="entry-header">

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>

				<div class="entry-meta">
					<?php _olea_posted_on(); ?>
					<div class="entry-meta-sep">•</div>
					<?php echo do_shortcode('[rt_reading_time label="" postfix="mins read" postfix_singular="min read"]'); ?>
				</div><!-- .entry-meta -->

			<?php endif; ?>

		</header><!-- .entry-header -->

		

		<div class="entry-content">

			<?php 
			
			echo wp_trim_words( get_the_content(), 20, '... + <a class="inline-read-more" href="'.$permalink.'"> Read More</a>' ); ?>	


			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', '_olea' ),
				'after'  => '</div>',
			) );
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php
			$author_id = $post->post_author;
			$author_first_name = get_the_author_meta('first_name', $author_id );
			$author_last_name = get_the_author_meta('last_name', $author_id );
			$author_nickname = get_the_author_meta('nickname', $author_id );
			?>
			<div class="author-panel small">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>author/<?php echo $author_nickname; ?>">
				    <img src="<?php echo esc_url( get_avatar_url( $author_id ) ); ?>" />
				    <h5><?php echo $author_first_name.' '.$author_last_name; ?></h5>
				</a>
			</div>

		</footer><!-- .entry-footer -->

	</div>

</article><!-- #post-## -->
