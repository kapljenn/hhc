<?php

/* Single template */

get_header();

while ( have_posts() ) : the_post();

	// slide header
	$html_id_attribute = htmlID(get_the_title());
	echo '	<section class="slide whiteSlide fade kenBurns single_central_column" id="' . $html_id_attribute . '"">
				<div class="content">
					<div class="container">
						<div class="wrap">';
?>

							<div class="fix-10-12">
<?php
	if ((get_post_type() == "blog-article") || (get_post_type() == "news-article")) {
		echo '<span class="publish-date">' . get_the_date('d F Y') . '</span>';
	}
?>
								<h1 class="ae-1"><?php the_title(); ?></h1>
								<div class="ae-2">
									<?php the_content(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

<?php endwhile; ?>

<?php

get_footer();

?>
