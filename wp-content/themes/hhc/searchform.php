<form action="<?php echo site_url('/'); ?>" method="get">
	<label for="search">Search in <?php echo home_url( '/' ); ?></label>
	<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
	<input type="image" alt="Search" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/search.png" />
</form>