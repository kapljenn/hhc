<?php

/* Single post template */

get_header();

?>

	<div class="container">

<?php while ( have_posts() ) : the_post(); ?>

		<div class="post-container">

			<div class="image-container">
				<?php the_post_thumbnail('full'); ?>
			</div>
			<div class="post-content">
				<h1><?php the_title(); ?></h1>
				<div class="post-description"><?php the_content(); ?></div>
			</div>

<?php endwhile; ?>

		</div>
	</div>

<?php

get_footer();

?>
