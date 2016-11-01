<?php

/* Archive page template */

get_header();

?>

	<div class="container">
		<div class="breadcrumbs">
			<a href="<?php echo home_url(); ?>">Home</a> > <?php echo single_cat_title(); ?>
		</div>
		<div class="post-grid clearfix">

<?php
		if ( have_posts() ) {
			while ( have_posts() ) : the_post();
?>
					<a class="post-item" href="<?php the_permalink(); ?>">
						<div class="img-holder">
							<?php the_post_thumbnail('medium'); ?>
						</div>
						<div class="post-detail">
							<h2 class="post-title"><?php the_title(); ?></h2>
						</div>
			    	</a>
<?php
			endwhile;
		}
?>

		</div>
	</div>

<?php

get_footer();

?>
