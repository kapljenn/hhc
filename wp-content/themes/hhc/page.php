<?php

/* Page template */

get_header();

while ( have_posts() ) : the_post();

	// loop through the slides in this page...
	if( have_rows('slides') ):

	    while ( have_rows('slides') ) : the_row();

			// get slide ID and content
			$slide = get_sub_field('slide');
			$slide_id = $slide->ID;
			$slide_content = str_replace("<h1", "<h1 style='display: none !important'", apply_filters('the_content', $slide->post_content));

			include('includes/slide.php');

	    endwhile;
	endif;
endwhile;
?>




<?php

get_footer();

?>
