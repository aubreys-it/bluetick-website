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
	//echo $permalink;
	?>
	<a href="<?php echo $permalink; ?>">
		<div class="post-content-wrapper">
			<div class="row row-eq-height align-items-center">
				<div class="col-5 case-study-logo">
					<div class="circle-logo" style="background-color: <?php echo get_field('company_color'); ?>">
						<img src="<?php echo get_field('company_logo'); ?>">
					</div>
					<?php echo get_the_post_thumbnail( $post->ID, 'case-studies-image-xs' ); ?>
				</div>
				<div class="col-7">
					<?php the_title( sprintf( '<h2 class="entry-title">', esc_url( get_permalink() ) ),
				'</h2>' ); ?>
				<h5>Case Study</h5>
				</div>
			</div>
		</div>
	</a>

</article><!-- #post-## -->
