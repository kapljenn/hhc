<?php

/* Single template */

/*

		THIS TEMPLATE NEEDS TO BE COPIED AND PASTED FROM PAGE.PHP TO BE KEPT UP TO DATE.

*/


get_header();

			// slide header
			echo '	<section class="slide">
						<div class="content">
							<div class="container">
								<div class="wrap">';

while ( have_posts() ) : the_post();

echo '<h1>' . get_the_title() . '</h1>';

the_content();

endwhile;

?>

		</div> <!-- wrap -->
	</div> <!-- container -->
</div> <!-- content -->


</section>

<?php 

get_footer();

?>
