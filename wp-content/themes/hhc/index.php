<?php
/*
 * The main template file.
 */

get_header();

?>
	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile; ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</div>
<?php

get_footer();

?>
