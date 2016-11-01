<?php

/* Sidebar */

?>

<div class="sidebar">
	<div class="related">
		<h2>More articles</h2>
<?php
		wp_reset_query();
		global $wp_query;
		$args = array('posts_per_page' => 3);
		$wp_query = new WP_Query($args);
		if ( have_posts() ) {
			while ( have_posts() ) : the_post();
?>
				<div class="related-item">
					<a href="<?php the_permalink(); ?>" class="post-item">
						<div class="img-holder">
							<?php the_post_thumbnail('medium'); ?>
						</div>
						<div class="post-detail">
							<h2 class="post-title"><?php the_title(); ?></h2>
						</div>
					</a>
		    	</div>
<?php 
			endwhile;
		}
?>
	</div>
</div>