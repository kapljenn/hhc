<?php

/* Single slide template */

/*

		THIS TEMPLATE NEEDS TO BE COPIED AND PASTED FROM PAGE.PHP TO BE KEPT UP TO DATE.

*/


get_header();

while ( have_posts() ) : the_post();

	// get slide ID and content
	$slide_id = get_the_ID();
	$slide_content = str_replace("<h1", "<h1 style='display: none !important'", get_the_content());

	include('includes/slide.php');

endwhile;

get_footer();

?>
