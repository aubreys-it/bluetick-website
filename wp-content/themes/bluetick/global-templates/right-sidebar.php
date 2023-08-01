<?php
/**
 * Right sidebar.
 *
 * @package _olea
 */

?>

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

<div class="sticky-sidebar">
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

<div class="popular-posts sidebar-widget">
	<h3>Popular Stories</h3>
	<ul>
		<?php $popular = new WP_Query(array('posts_per_page'=>4, 'meta_key'=>'popular_posts', 'orderby'=>'meta_value_num', 'order'=>'DESC'));
		while ($popular->have_posts()) : $popular->the_post(); ?>
		<li>
			<a class="popular-posts-img" href="<?php echo $permalink; ?>">		
				<?php echo get_the_post_thumbnail( $post->ID, 'post-image-xs' ); ?>
			</a>
			<div class="popular-posts-content">
				<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
				<div class="popular-posts-categories">
					<?php _olea_posted_on(); ?>
				</div>
			</div>
		</li>
		<?php endwhile; wp_reset_postdata(); ?>
	</ul>
</div>

<div class="sidebar-categories sidebar-widget">
	<h3>Categories</h3>
	<?php 
	$categories = get_categories();
	foreach($categories as $category) {
	   echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
	}
	?>

	
</div>
<?php
if(is_active_sidebar('right-sidebar')){
	//dynamic_sidebar('right-sidebar');
}
?>
</div>
