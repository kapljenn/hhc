<?php

get_header(); 

?>

	<div class="container">

	<?php if ( have_posts() ) : ?>

		<div class="search-results clearfix">

			<h1>Search results for: <?php the_search_query(); ?></h1>
			<?php while ( have_posts() ) : the_post(); ?>

				<article class="search-entry">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="search-entry-excerpt">
						<?php the_excerpt(); ?>
						<a class="read-more" href="<?php the_permalink(); ?>">Read more</a>
					</div>
				</article>

			<?php endwhile; ?>

		</div>

	<?php else : ?>
	
		<div class="no-results">Your search returned no results.</div>

	<?php endif; ?>

	</div>

<?php

get_sidebar();
get_footer();

?>
