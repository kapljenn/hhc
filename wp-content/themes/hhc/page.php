<?php

/* Page template */

get_header();

while ( have_posts() ) : the_post();

	// loop through the slides in this page...
	if( have_rows('slides') ):

	    while ( have_rows('slides') ) : the_row();

			$slide = get_sub_field('slide');
			$slide_id = $slide->ID;

			// slide variables
			$slide_type = get_field('slide_type', $slide_id);
			$slide_palette = get_field('slide_palette', $slide_id);
			$slide_content = apply_filters('the_content', $slide->post_content);
			$cta = get_field('cta', $slide_id);
			$hero_alignment = get_field('hero_alignment', $slide_id);

			// slide title
			$title_colour = get_field('title_colour', $slide_id);
			$title_html = '<h1 class="ae-1" style="color: ' . $title_colour . '">' . $slide->post_title . '</h1>';
			$title_format = get_field('title_format', $slide_id);
			$title_image = get_field('title_image', $slide_id);
			if ($title_format == "image") {
				if ($title_image != null) {
					$title_image = $title_image['url'];
					$title_html = "<img class='slide-title' src='" . $title_image . "'>";
				}
			} else if ($title_format == "no_title") $title_html = "";

			// slide classes
			$slide_classes = "fade kenBurns ";
			if ($slide_palette == "dark_text_white_background") $slide_classes = "whiteSlide ";
			if ($slide_palette == "dark_text_grey_background") $slide_classes = "whiteSlide greyTint ";
			$slide_classes .= $slide_type;

			// columns
			$columns = get_field('columns', $slide_id);

			// video
			$video_url = get_field('video_url', $slide_id);
			$video_cta_position = get_field('video_cta_position', $slide_id);

			// CTA position
			$cta_position = get_field('cta_position', $slide_id);

			// make HTML ID attribute
			$html_id_attribute = htmlID($slide->post_title);

			// slide header
			echo '	<section class="slide ' . $slide_classes . '" id="' . $html_id_attribute . '"">
						<div class="content">
							<div class="container">
								<div class="wrap">';

?>









<?php if ($slide_type == "header_with_columns") { ?>
<div class="fix-10-12 <?php echo $hero_alignment; ?>">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
	<?php if ($cta_position == "before_the_columns") { ?>
		<?php include('includes/cta.php'); ?>
	<?php } ?>
</div>

<?php if ($columns != false) { ?>
<div class="fix-12-12">
	<ul class="grid later equal">
<?php
		$column_fraction = floor(12/sizeOf($columns));
		foreach ($columns as $c) {
			$column_text_colour = $c['column_text_colour'];
			$column_text = $c['column_text'];
			$column_icon = $c['column_icon'];
			$column_title = $c['column_title'];
			$column_url = $c['column_url'];
			$column_image = $c['column_image'];
?>
		<li class="col-<?php echo $column_fraction; ?>-12">
			<div class="fix-<?php echo $column_fraction; ?>-12">
<?php if ($column_icon != null) { ?>
				<div class="img-holder">
					<img class="column-icon" src="<?php echo $column_icon['url']; ?>" />
				</div>
<?php } ?>
<?php if ($column_image != null) { ?>
				<div class="img-holder">
					<img class="column-image" src="<?php echo $column_image['url']; ?>" />
				</div>
<?php } ?>
				<h3 class="equalElement ae-7" style="color: <?php echo $column_text_colour; ?>">
<?php
	if ($column_url['url'] != null) echo '<a href="' . $column_url['url'] . '">' . $c['column_title'] . '</a>';
	else echo $column_title;
?>
				</h3>
				<div class="ae-4">
					<p class="small" style="color: <?php echo $column_text_colour; ?>"><?php echo $column_text; ?></p>
				</div>
			</div>
		</li>
<?php } ?>
				</ul>
			</div>
<?php } ?>
<?php if ($cta_position == "after_the_columns") { ?>
	<?php include('includes/cta.php'); ?>
<?php } ?>







<?php } else if ($slide_type == "side_by_side") { ?>
<?php
	$left_image = get_field('left_image', $slide_id);
	$right_image = get_field('right_image', $slide_id);
	$column_ratio = get_field('column_ratio', $slide_id);

	$left_side_icons = get_field('left_side_icons', $slide_id);
	$right_side_icons = get_field('right_side_icons', $slide_id);
?>
<?php if ($left_image) { ?>
<div class="left-hand-image">
	<img class="shiftImage shiftImageVertical" src="<?php echo $left_image['url']; ?>" width="1200">
</div>
<?php } ?>
<?php if ($right_image) { ?>
<div class="right-hand-image">
	<img class="shiftImage shiftImageVertical" src="<?php echo $right_image['url']; ?>" width="1200">
</div>
<?php } ?>
<div class="fix-10-12">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
</div>
<div class="fix-12-12">
	<ul class="grid">
		<li class="col-<?php echo substr($column_ratio, 0, 1); ?>-12 left">
			<div class="ae-3">
<?php
	if ($left_side_icons) {
		if ($left_side_icons != "") {
			$the_query = new WP_Query(array('post_type' => $left_side_icons, 'posts_per_page' => -1));
			if ( $the_query->have_posts() ) {
				echo '<ul class="grid">';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$post_id = get_the_ID();
					$partner_logo = get_field('partner_logo', $post_id)['url'];
					if ($slide_palette == "white_text_dark_background") $partner_logo = get_field('partner_logo_inverted', $post_id)['url'];
					$partner_url = get_field('partner_url', $post_id);
					echo '<li class="partner"><a href="' . $partner_url . '"><img src="' . $partner_logo . '"></a></li>';
				}
				echo '</ul>';
			}
			wp_reset_postdata();
		} else {
			the_field('left_side_text', $slide_id);
			echo "&nbsp;";
		}
	} else {
		the_field('left_side_text', $slide_id);
		echo "&nbsp;";
	}
?>
			</div>
		</li>
		<li class="col-<?php echo substr($column_ratio, 2, 3); ?>-12 left">
			<div class="ae-3">
<?php
	if ($right_side_icons) {
		if ($right_side_icons != "") {
			$the_query = new WP_Query(array('post_type' => $right_side_icons, 'posts_per_page' => -1));
			if ( $the_query->have_posts() ) {
				echo '<ul class="grid">';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$post_id = get_the_ID();
					$partner_logo = get_field('partner_logo', $post_id)['url'];
					if ($slide_palette == "white_text_dark_background") $partner_logo = get_field('partner_logo_inverted', $post_id)['url'];
					$partner_url = get_field('partner_url', $post_id);
					echo '<li class="partner"><a href="' . $partner_url . '"><img src="' . $partner_logo . '"></a></li>';
				}
				echo '</ul>';
			}
			wp_reset_postdata();
		} else {
			the_field('right_side_text', $slide_id);
			echo "&nbsp;";
		}
	} else {
		the_field('right_side_text', $slide_id);
		echo "&nbsp;";
	}
?>
			</div>
		</li>
	</ul>
</div>
<?php include('includes/cta.php'); ?>











<?php } else if ($slide_type == "single_central_column") { ?>
<div class="fix-10-12">
<?php
if ($video_url != "") {
	if ($video_cta_position == "top") {
		echo '<div class="button play white popupTrigger ae-2 fromCenter button-9" data-popup-id="9"></div>';
	}
}
?>
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
<?php
		// partners
		$post_list = get_field('post_list', $slide_id);
		$post_list_classes = get_field('post_list_classes', $slide_id);
		if ($post_list != false) {
			echo "<ul class='post-grid " . $post_list_classes . "'>";
			$column_fraction = floor(12/sizeOf($post_list));
			foreach ($post_list as $p) {

				$p = $p['post_item'];

				if ($p->post_type == 'partner') {
					$partner_logo = get_field('partner_logo', $p->ID)['url'];
					if ($slide_palette == "white_text_dark_background") $partner_logo = get_field('partner_logo_inverted', $p->ID)['url'];
					$partner_url = get_field('partner_url', $p->ID);
					echo '<li class="partner"><a href="' . $partner_url . '"><img src="' . $partner_logo . '"></a></li>';
				} else if ($p->post_type == 'global-contact') {
					//var_dump($p);
					echo $p->ID;
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($p->ID), 'medium')[0];
					$title = $p->post_title;
					$excerpt = get_the_excerpt($p->ID);
					$permalink = $p->permalink;
					echo '<li class="global-contact">';
						echo '<div class="img-holder">';
							echo '<img src="' . $thumb . '">';
						echo '</div>';
						echo '<div class="post-content">';
							echo '<a href="' . $permalink . '" class="post-title">' . $title . '</a>';
							echo '<div class="post-excerpt">' . $excerpt . '</div>';
						echo '</div>';
					echo '</li>';
				} else if ($p->post_type == 'job') {
					//var_dump($p);
					echo $p->ID;
					//$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($p->ID), 'medium')[0];
					$title = $p->post_title;
					$excerpt = get_the_excerpt($p->ID);
					$permalink = $p->permalink;
					echo '<li class="job">';
						// echo '<div class="img-holder">';
						// 	echo '<img src="' . $thumb . '">';
						// echo '</div>';
						echo '<div class="post-content">';
							echo '<a href="' . $permalink . '" class="post-title">' . $title . '</a>';
							echo '<div class="post-excerpt">' . $excerpt . '</div>';
						echo '</div>';
					echo '</li>';
				} else if ($p->post_type == 'download') {
					//var_dump($p);
					echo $p->ID;
					//$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($p->ID), 'medium')[0];
					$title = $p->post_title;
					$excerpt = get_the_excerpt($p->ID);
					$permalink = get_field('file', $p->ID)['url'];
					echo '<li class="download">';
						// echo '<div class="img-holder">';
						// 	echo '<img src="' . $thumb . '">';
						// echo '</div>';
						echo '<div class="post-content">';
							echo '<a href="' . $permalink . '" class="post-title">' . $title . '</a>';
							echo '<div class="post-excerpt">' . $excerpt . '</div>';
						echo '</div>';
					echo '</li>';
				}
			}
			echo "</ul>";
		}
?>
<?php include('includes/cta.php'); ?>

<!-- video -->
<?php
if ($video_url != "") {
	if ($video_cta_position == "bottom") {
		echo '<div class="button play white popupTrigger ae-2 fromCenter button-9" data-popup-id="9"></div>';
	}
}
?>

<!-- box links -->
<?php
	$box_links = get_field('box_links', $slide_id);
	if ($box_links != false) {
		echo "<div class='cta-bar'>";
		foreach ($box_links as $l) {
			$link_title = $l['link_title'];
			$link_url = $l['link_url'];
			echo '<a class="button ae-5 fromCenter" href="' . $link_url . '">' . $link_title . '</a>';
		}
		echo "</div>";
	}
?>
</div>





<?php } else if ($slide_type == "featured_item") { ?>
<?php
	query_posts( array( 'post_type' => array('blog-article'), 'posts_per_page' => -1 ));
	$counter = 0;
	if (have_posts()) : while(have_posts()) : the_post();
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($link->ID), 'medium' )['0'];

		if ($counter == 0) {
			echo '<div class="fix-12-12">';
				echo '<div class="blog-article featured">';
					echo '<div class="img-holder">';
						echo '<img src="' . $thumb . '">';
					echo '</div>';
					echo '<div class="post-content">';
						echo '<div class="post-title">' . get_the_title() . '</div>';
						echo '<a class="button ae-5 fromCenter" href="' . get_the_permalink() . '">Read post</a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

			echo '<div class="fix-10-12">';
				echo '<ul class="post-grid">';

		} else {
				echo '<li class="blog-article">';
					echo '<div class="img-holder">';
						echo '<img src="' . $thumb . '">';
					echo '</div>';
					echo '<div class="post-content">';
						echo '<a href="' . get_the_permalink() . '" class="post-title">' . get_the_title() . '</a>';
						echo '<div class="post-excerpt">' . get_the_excerpt() . '</div>';
					echo '</div>';
				echo '</li>';
		}

		$counter++;

	endwhile; 
	echo '</ul></div>';
	endif;
?>

<?php include('includes/cta.php'); ?>










<?php } else if ($slide_type == "map") { ?>
<div class="fix-10-12 <?php echo $hero_alignment; ?>">
	<?php echo $title_html; ?>
	<BR><BR><BR><BR><BR><BR><BR><BR><BR>
	<div class="ae-2"><?php echo $slide_content; ?></div>
</div>

<?php if ($columns != false) { ?>
<div class="fix-12-12">
	<ul class="grid later equal">
<?php
		$column_fraction = floor(12/sizeOf($columns));
		foreach ($columns as $c) {
			$column_text_colour = $c['column_text_colour'];
			$column_icon = $c['column_icon'];
			$column_image = $c['column_image'];
?>
		<li class="col-<?php echo $column_fraction; ?>-12">
			<div class="fix-<?php echo $column_fraction; ?>-12">
<?php if ($c['column_icon'] != null) { ?>
				<div class="img-holder">
					<img class="column-icon" src="<?php echo $column_icon['url']; ?>" />
				</div>
<?php } ?>
<?php if ($c['column_image'] != null) { ?>
				<div class="img-holder">
					<img class="column-image" src="<?php echo $column_image['url']; ?>" />
				</div>
<?php } ?>
				<h3 class="equalElement ae-7" style="color: <?php echo $column_text_colour; ?>"><?php echo $c['column_title']; ?></h3>
				<div class="ae-4">
					<p class="small" style="color: <?php echo $column_text_colour; ?>"><?php echo $c['column_text']; ?></p>
				</div>
			</div>
		</li>
<?php } ?>
				</ul>
			</div>
<?php } ?>








<?php } else if ($slide_type == "three_thumbnails") { ?>
<?php $thumbnails = get_field('thumbnails', $slide_id); ?>
<div class="fix-10-12 <?php echo $hero_alignment; ?>">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
</div>
<?php if ($thumbnails != false) { ?>
<div class="fix-12-12">
	<ul class="grid later equal">
<?php
		foreach ($thumbnails as $t) {
			$thumbnail_image = $t['thumbnail_image'];
			$thumbnail_title = $t['thumbnail_title'];
			$thumbnail_url = $t['thumbnail_url'];
?>
		<li class="col-4-12">
			<div class="fix-4-12">
				<a href="<?php echo $thumbnail_url; ?>" class="thumbnail-link">
					<img src="<?php echo $thumbnail_image['url']; ?>" />
					<div class="thumbnail-content">
						<span class="thumbnail-title"><?php echo $thumbnail_title; ?></span>
					</div>
				</a>
			</div>
		</li>
<?php } ?>
	</ul>
</div>
<?php } ?>











<?php } else { echo "No slide template defined!"; } ?>

			



<!-- footer -->
			<div class="fix-12-12">
				<nav class="panel bottom">
					<div class="sections">
						<div class="center">
							<span class="nextSlide">
								<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/down-arrow.png" />
							</span>
						</div>
					</div>
				</nav>
			</div>
		</div> <!-- wrap -->
	</div> <!-- container -->
</div> <!-- content -->


<?php
			// background image
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($slide_id), 'large' )['0'];
			if ($featured_image != null) {
				echo '<div class="background" style="background-image:url(' . $featured_image . ') !important"></div>';
			}
			echo '</section>';
?>





<?php
if ($slide_type == "video") {
?>
			<!-- Popup Video -->
			<div class="popup autoplay" data-popup-id="9">
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
<?php

}
	    endwhile;
	endif;
endwhile;
?>




<?php

get_footer();

?>
