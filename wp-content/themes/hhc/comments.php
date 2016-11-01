<?php

if ( post_password_required() ) return;

?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) { ?>
		<h2 class="comments-title">Comments on <?php the_title(); ?></h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
				) );
			?>
		</ol>

	<?php } ?>

	<?php comment_form(); ?>

</div>
