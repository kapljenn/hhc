<?php

/* Page template */

get_header();

while ( have_posts() ) : the_post();

	// loop through the slides in this page...
	if( have_rows('slides') ):

	    while ( have_rows('slides') ) : the_row();

			// slide data
			$slide = get_sub_field('slide');
			$slide_id = $slide->ID;

			// $postURL = get_permalink($postobject->ID); //URL
			// apply_filters('the_content', $postobject->post_content); //The post content formatted
			// $postdate->post_date; //post publish date
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($slide_id), 'large' )['0'];
			$slide_classes = "fade kenBurns";
			if (get_field('white_slide', $slide_id) == true) $slide_classes = "whiteSlide";

			// slide header
			echo '<section class="slide ' . $slide_classes . '"><div class="content"><div class="container"><div class="wrap">';




			echo $slide->post_title;




			// slide footer
	      	echo '</div></div></div>';
			if ($featured_image != null) echo '<div class="background" style="background-image:url(' . $featured_image . ')"></div>';
			echo '</section>';

			// popup video
			/*
			<!-- Popup Video -->
			<div class="popup autoplay" data-popup-id="91-4">
			  <div class="close"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close"></use></svg></div>
			  <div class="content">
			    <div class="container">
			      <div class="wrap">
			        <div class="fix-10-12">
			          <div class="embedVideo popupContent">
			            <iframe src="https://player.vimeo.com/video/101231747?color=ff0179&portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			          </div>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
			*/

	    endwhile;

	endif;

endwhile;

get_footer();

?>
