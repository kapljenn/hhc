<?php
			// slide variables
			$slide_type = get_field('slide_type', $slide_id);
			$slide_palette = get_field('slide_palette', $slide_id);
			$cta = get_field('cta', $slide_id);
			$hero_alignment = get_field('hero_alignment', $slide_id);

			// slide title
			$slide_title = get_the_title($slide_id);
			$title_colour = get_field('title_colour', $slide_id);
			$title_html = '<h1 class="ae-1" style="color: ' . $title_colour . '">' . $slide_title . '</h1>';
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
			$html_id_attribute = htmlID($slide_title);

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
		<?php include('cta.php'); ?>
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
			$external_url_override = $c['external_url_override'];
			$column_image = $c['column_image'];
?>
		<li class="col-<?php echo $column_fraction; ?>-12">
			<div class="fix-<?php echo $column_fraction; ?>-12">
<?php if ($column_icon != null) { ?>
				<div class="icon-holder">
					<img src="<?php echo $column_icon['url']; ?>" />
				</div>
<?php } ?>
<?php if ($column_image != null) { ?>
				<div class="img-holder">
					<img src="<?php echo $column_image['url']; ?>" />
				</div>
<?php } ?>
				<h2 class="equalElement ae-7" style="color: <?php echo $column_text_colour; ?>">
<?php
	if ($external_url_override != null) echo '<a target="_blank" style="color: ' . $column_text_colour . '" href="' . $external_url_override . '">' . $column_title . '</a>';
	else if ($column_url != null) echo '<a style="color: ' . $column_text_colour . '" href="' . $column_url . '">' . $column_title . '</a>';
	else echo $column_title;
?>
				</h2>
				<div class="ae-4">
					<p style="color: <?php echo $column_text_colour; ?>"><?php echo str_replace('<p>', '<p style="color: '.$column_text_colour.';">', $column_text); ?></p>
				</div>
			</div>
		</li>
<?php } ?>
				</ul>
			</div>
<?php } ?>
<?php if ($cta_position == "after_the_columns") { ?>
	<?php include('cta.php'); ?>
<?php } ?>







<?php } else if ($slide_type == "side_by_side") { ?>
<?php
	$left_image = get_field('left_image', $slide_id);
	$left_image_src = $left_image['sizes']['large'];
	$right_image = get_field('right_image', $slide_id);
	$right_image_src = $right_image['sizes']['large'];
	$column_ratio = get_field('column_ratio', $slide_id);

	$left_side_icons = get_field('left_side_icons', $slide_id);
	$right_side_icons = get_field('right_side_icons', $slide_id);
?>
<?php if ($left_image) { ?>
<div class="left-hand-image">
	<img class="shiftImage shiftImageVertical" src="<?php echo $left_image_src; ?>" width="1200">
</div>
<?php } ?>
<?php if ($right_image) { ?>
<div class="right-hand-image">
	<img class="shiftImage shiftImageVertical" src="<?php echo $right_image_src; ?>" width="1200">
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
					if (strlen($partner_url) > 7) {
						echo '<li class="partner"><a href="' . $partner_url . '" style="background-image: url(' . $partner_logo . ')"></a></li>';
					}
					else {
						echo '<li class="partner"><div style="background-image: url(' . $partner_logo . ')"></div></li>';
					}
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
					if (strlen($partner_url) > 7) {
						echo '<li class="partner"><a href="' . $partner_url . '" style="background-image: url(' . $partner_logo . ')"></a></li>';
					}
					else {
						echo '<li class="partner"><div style="background-image: url(' . $partner_logo . ')"></div></li>';
					}
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
<?php include('cta.php'); ?>











<?php } else if ($slide_type == "single_central_column") { ?>
<div class="fix-10-12">
<?php
if ($video_url != "") {
	if ($video_cta_position == "top") {
		//echo '<div class="button play white popupTrigger ae-2 fromCenter button-9" data-popup-id="9"></div>';
		echo '<a target="_blank" href="' . $video_url . '" class="play-video"></a>';
	}
}
?>
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
<?php
		// post type
		$post_list = get_field('post_list', $slide_id);
		$post_list_classes = get_field('post_list_classes', $slide_id);

		// print out filters
		if (stripos($post_list_classes, 'publications-grid') !== false) {
			echo '<div class="publications-filters">
			<p><input type="text" id="quicksearch" placeholder="Search" /></p>
			<div id="filters" class="button-group"><button class="button publication-btn publication-btn-first" data-filter=".fundraising-tools">Fundraising Tools</button><button class="button publication-btn" data-filter=".training">Training</button><button class="button publication-btn" data-filter=".campaigns">Campaigns</button><button class="button publication-btn publication-btn-last" data-filter=".publications">Publications</button></div>
			</div>';
		}
		else if (stripos($post_list_classes, 'fundraising-tools-grid') !== false) {
			echo '<div class="fundraising-tools-filters">
			<p><input type="text" id="quicksearch" placeholder="Search" /></p>
			<div id="filters" class="button-group"><button class="button fundraising-tool-btn fundraising-tool-btn-first" data-filter=".fundraising-tools">Fundraising Tools</button><button class="button fundraising-tool-btn" data-filter=".training">Training</button><button class="button fundraising-tool-btn" data-filter=".campaigns">Campaigns</button><button class="button fundraising-tool-btn fundraising-tool-btn-last" data-filter=".fundraising-tools">Fundraising Tools</button></div>
			</div>';
		}
		
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
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($p->ID), 'medium')[0];
					$title = $p->post_title;
					$excerpt = get_the_excerpt($p->ID);
					$permalink = get_permalink($p->ID);
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
					//$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($p->ID), 'medium')[0];
					$title = $p->post_title;
					$excerpt = get_the_excerpt($p->ID);
					$permalink = get_permalink($p->ID);
					echo '<li class="job">';
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
<?php include('cta.php'); ?>

<!-- video -->
<?php
if ($video_url != "") {
	if ($video_cta_position == "bottom") {
		//echo '<div class="button play white popupTrigger ae-2 fromCenter button-9" data-popup-id="9"></div>';
		echo '<a target="_blank" href="' . $video_url . '" class="play-video"></a>';
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

<!-- post loop -->
<?php
	$post_loop = get_field('post_loop', $slide_id);
	if ($post_loop != false) {

		// normal query
		$the_query = new WP_Query(array( 'post_type' => $post_loop, 'posts_per_page' => -1 ));

		// if we're dealing with a people post type, order the items alphabetically
		$people_post_types = array("patron", "trustee", "executive-leader", "spokesperson");
		if (in_array($post_loop, $people_post_types)) {
			$the_query = new WP_Query(array( 'post_type' => $post_loop, 'posts_per_page' => -1 , 'orderby' => 'title' , 'order' => 'ASC' ));
		}

		// if we're dealing with events or challenges, order the items by start date
		$calendar_based_post_types = array("event", "challenge");
		if (in_array($post_loop, $calendar_based_post_types)) {
			$the_query = new WP_Query(array( 'post_type' => $post_loop, 'posts_per_page' => -1 , 'meta_key' => 'start' , 'orderby' => 'meta_value' , 'order' => 'ASC' ));
		}

		if ( $the_query->have_posts() ) {
			echo "<ul class='post-grid " . $post_list_classes . "'>";
			while ( $the_query->have_posts() ) {
				$the_query->the_post();

				// publications
				if (get_post_type() == "publication") {
					$title = get_the_title();
					$excerpt = get_the_excerpt();
					$file_url = get_field('file')['url'];
					
					$categories = get_the_category();
					
					echo '<li class="publication publication-grid-item initially-hidden '.esc_html( $categories[0]->slug ).'">';
						// echo '<div class="img-holder">';
						// 	echo '<img src="' . $thumb . '">';
						// echo '</div>';
						echo '<div class="post-content">';
							echo '<a href="' . $file_url . '" class="post-title">' . $title . '</a>';
							echo '<div class="post-excerpt">' . $excerpt . '</div>';
						echo '</div>';
					echo '</li>';
				}

				// fundraising tools
				else if (get_post_type() == "fundraising-tool") {
					$title = get_the_title();
					$excerpt = get_the_excerpt();
					$file_url = get_field('file')['url'];
					
					$categories = get_the_category();
					
					echo '<li class="fundraising-tool fundraising-tool-grid-item initially-hidden '.esc_html( $categories[0]->slug ).'">';
						// echo '<div class="img-holder">';
						// 	echo '<img src="' . $thumb . '">';
						// echo '</div>';
						echo '<div class="post-content">';
							echo '<a href="' . $file_url . '" class="post-title">' . $title . '</a>';
							echo '<div class="post-excerpt">' . $excerpt . '</div>';
						echo '</div>';
					echo '</li>';
				}

				// trustee
				else if (get_post_type() == "trustee") {
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($link->ID), 'medium' )['0'];
					echo '<li class="blog-article">';
					if ($thumb) {
						echo '<div class="img-holder">';
							echo '<a href="' . get_the_permalink() . '" class="post-title"><img src="' . $thumb . '"></a>';
						echo '</div>';
					}
						echo '<div class="post-content">';
							echo '<a href="' . get_the_permalink() . '" class="post-title">' . get_the_title() . '</a>';
						echo '</div>';
					echo '</li>';
				}
				
				//event
				else if (get_post_type() == "event") {
					if(date('Y-m-d', strtotime(get_field('unpublish_date'))) > date('Y-m-d'))
					{
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($link->ID), 'medium' )['0'];
						echo '<li class="blog-article">';
						if ($thumb) {
							echo '<div class="img-holder">';
								echo '<img src="' . $thumb . '">';
							echo '</div>';
						}
							echo '<div class="post-content">';
								echo '<a href="' . get_the_permalink() . '" class="post-title">' . get_the_title() . '</a>';
								echo '<div class="post-excerpt">' . get_the_excerpt() . '</div>';
							echo '</div>';
						echo '</li>';
					}
				}
								
				// any other post type
				else {
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($link->ID), 'medium' )['0'];
					echo '<li class="blog-article">';
					if ($thumb) {
						echo '<div class="img-holder">';
							echo '<img src="' . $thumb . '">';
						echo '</div>';
					}
						echo '<div class="post-content">';
							echo '<a href="' . get_the_permalink() . '" class="post-title">' . get_the_title() . '</a>';
							echo '<div class="post-excerpt">' . get_the_excerpt() . '</div>';
						echo '</div>';
					echo '</li>';
				}
			}
			echo '</ul>';
		}
		wp_reset_postdata();
	}
?>








<!-- post loop latest -->
<?php
	$post_loop = get_field('post_loop_latest', $slide_id);
	if ($post_loop != false) {

		// normal query
		$the_query = new WP_Query(array( 'post_type' => $post_loop, 'posts_per_page' => 4 ));

		// if we're dealing with a people post type, order the items alphabetically
		$people_post_types = array("patron", "trustee", "executive-leader", "spokesperson");
		if (in_array($post_loop, $people_post_types)) {
			$the_query = new WP_Query(array( 'post_type' => $post_loop, 'posts_per_page' => 4 , 'orderby' => 'title' , 'order' => 'ASC' ));
		}

		// if we're dealing with events or challenges, order the items by start date
		$calendar_based_post_types = array("event", "challenge");
		if (in_array($post_loop, $calendar_based_post_types)) {
			$the_query = new WP_Query(array( 'post_type' => $post_loop, 'posts_per_page' => 4 , 'meta_key' => 'start' , 'orderby' => 'meta_value' , 'order' => 'ASC' ));
		}

		if ( $the_query->have_posts() ) {
			echo "<ul class='post-grid " . $post_list_classes . "'>";
			while ( $the_query->have_posts() ) {
				$the_query->the_post();

				// publications
				if (get_post_type() == "publication") {
					$title = get_the_title();
					$excerpt = get_the_excerpt();
					$file_url = get_field('file')['url'];
					
					$categories = get_the_category();
					
					echo '<li class="publication publication-grid-item initially-hidden '.esc_html( $categories[0]->slug ).'">';
						// echo '<div class="img-holder">';
						// 	echo '<img src="' . $thumb . '">';
						// echo '</div>';
						echo '<div class="post-content">';
							echo '<a href="' . $file_url . '" class="post-title">' . $title . '</a>';
							echo '<div class="post-excerpt">' . $excerpt . '</div>';
						echo '</div>';
					echo '</li>';
				}

				// fundraising tools
				else if (get_post_type() == "fundraising-tool") {
					$title = get_the_title();
					$excerpt = get_the_excerpt();
					$file_url = get_field('file')['url'];
					
					$categories = get_the_category();
					
					echo '<li class="fundraising-tool fundraising-tool-grid-item initially-hidden '.esc_html( $categories[0]->slug ).'">';
						// echo '<div class="img-holder">';
						// 	echo '<img src="' . $thumb . '">';
						// echo '</div>';
						echo '<div class="post-content">';
							echo '<a href="' . $file_url . '" class="post-title">' . $title . '</a>';
							echo '<div class="post-excerpt">' . $excerpt . '</div>';
						echo '</div>';
					echo '</li>';
				}

				// any other post type
				else {
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($link->ID), 'medium' )['0'];
					echo '<li class="blog-article">';
					if ($thumb) {
						echo '<div class="img-holder">';
							echo '<img src="' . $thumb . '">';
						echo '</div>';
					}
						echo '<div class="post-content">';
							echo '<a href="' . get_the_permalink() . '" class="post-title">' . get_the_title() . '</a>';
							echo '<div class="post-excerpt">' . get_the_excerpt() . '</div>';
						echo '</div>';
					echo '</li>';
				}
			}
			echo '</ul>';
		}
		wp_reset_postdata();
	}
?>






<?php } else if ($slide_type == "map") { ?>
<div class="fix-10-12 <?php echo $hero_alignment; ?>">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
</div>
<div class="fix-12-12 map-container">
	<div class="map" id="map"></div>
	<div class="map-overlay">
		<div class="dot-purple">Countries of operation</div>
		<div class="dot-yellow">Countries of influence</div>
		<div class="dot-grey">Former countries of operation</div>
	</div>
</div>






<?php } else if ($slide_type == "zoomed_map") { ?>
<div class="fix-10-12 <?php echo $hero_alignment; ?>">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
</div>
<div class="fix-12-12">
	<div class="zoomed-map" id="zoomed_map"></div>
</div>








<?php } else if ($slide_type == "three_thumbnails") { ?>
<?php 
	$thumbnails = get_field('thumbnails', $slide_id); 
	$thumbnails_equal_height = get_field('thumbnails_equal_height', $slide_id) == true ? 'thumbnails-equal-height' : '';
?>
<div class="fix-10-12 <?php echo $hero_alignment; ?>">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
</div>
<?php if ($thumbnails != false) { ?>
<div class="fix-12-12">
	<ul class="grid later equal <?php echo $thumbnails_equal_height; ?>">
<?php
		foreach ($thumbnails as $t) {
			$thumbnail_image = $t['thumbnail_image'];
			$thumbnail_image_src = $thumbnail_image['sizes']['large'];
			$thumbnail_title = $t['thumbnail_title'];
			$thumbnail_url = $t['thumbnail_url'];

?>
		<li class="col-4-12">
			<div class="fix-4-12">
				<a href="<?php echo $thumbnail_url; ?>" class="thumbnail-link">
					<img src="<?php echo $thumbnail_image_src; ?>" />
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





<?php } else if ($slide_type == "latest_tweets") { ?>
<div class="fix-10-12 <?php echo $hero_alignment; ?>">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
</div>
<div class="fix-12-12">
	<?php include('twitter.php'); ?>
</div>






<?php } else if ($slide_type == "featured_item") { ?>
<div class="fix-10-12 <?php echo $hero_alignment; ?>">
	This slide type is no longer in use! Please use Single Central Column instead.
</div>







<?php } else { echo "No slide template defined!"; } ?>

			




		</div> <!-- wrap -->
	</div> <!-- container -->
</div> <!-- content -->


<?php
			// background image
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($slide_id), 'large' )['0'];
			if ($featured_image != null) {
				echo '<div class="background" style="background-image:url(' . $featured_image . ') !important"></div>';
			}
?>

</section>



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

?>