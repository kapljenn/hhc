<?php

/* Page template */

get_header();

while ( have_posts() ) : the_post();

	// loop through the slides in this page...
	if( have_rows('slides') ):

	    while ( have_rows('slides') ) : the_row();

			$slide = get_sub_field('slide');
			$slide_id = $slide->ID;

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

			// slide type
			$slide_type = get_field('slide_type', $slide_id);

			// slide palette
			$slide_palette = get_field('slide_palette', $slide_id);

			// hero alignment
			$hero_alignment = get_field('hero_alignment', $slide_id);

			// slide content
			$slide_content = apply_filters('the_content', $slide->post_content);

			// background image
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($slide_id), 'large' )['0'];

			// CTA(s)
			$cta_text = get_field('cta_text', $slide_id);
			$cta_url = get_field('cta_url', $slide_id);
			$cta_2_text = get_field('cta_2_text', $slide_id);
			$cta_2_url = get_field('cta_2_url', $slide_id);

			// slide classes
			$slide_classes = "fade kenBurns ";
			if ($slide_palette == "dark_text_white_background") $slide_classes = "whiteSlide ";
			if ($slide_palette == "dark_text_grey_background") $slide_classes = "whiteSlide greyTint ";
			$slide_classes .= $slide_type;

			// columns
			$columns = get_field('columns', $slide_id);

			// CTA position
			$cta_position = get_field('cta_position', $slide_id);

			// slide header
			echo '<section class="slide ' . $slide_classes . '"><div class="content"><div class="container"><div class="wrap">';

?>









<?php if ($slide_type == "header_with_columns") { ?>
<div class="fix-10-12 <?php echo $hero_alignment; ?>">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
	<?php if ($cta_position == "above_the_columns") { ?>
		<a class="button ae-5 fromCenter" href="<?php echo $cta_url; ?>"><?php echo $cta_text; ?></a>
	<?php } ?>
</div>

<?php if (sizeOf($columns) > 0) { ?>
<div class="fix-12-12">
	<ul class="grid later equal">
<?php
		$column_fraction = floor(12/sizeOf($columns));
		foreach ($columns as $c) {
			$column_text_colour = $c['column_text_colour'];
			$column_icon = $c['column_icon'];
			$column_image = $c['column_image'];
			$column_cta_text = $c['cta_text'];
			$column_cta_url = $c['cta_url'];

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
<?php if ($column_cta_text != null) { ?>
				<a class="column-cta" href="<?php echo $column_cta_url; ?>"><?php echo $column_cta_text; ?></a>
<?php } ?>
			</div>
		</li>
<?php } ?>
				</ul>
			</div>
<?php } ?>
<?php if ($cta_position == "below_the_columns") { ?>
	<a class="button ae-5 fromCenter" href="<?php echo $cta_url; ?>"><?php echo $cta_text; ?></a>
<?php } ?>







<?php } else if ($slide_type == "side_by_side") { ?>
<?php
	$left_image = get_field('left_image', $slide_id);
	$right_image = get_field('right_image', $slide_id);
	$column_ratio = get_field('column_ratio', $slide_id);
?>
<div class="left-hand-image">
	<img class="shiftImage shiftImageVertical" src="<?php echo $left_image['url']; ?>" width="1200">
</div>
<div class="right-hand-image">
	<img class="shiftImage shiftImageVertical" src="<?php echo $right_image['url']; ?>" width="1200">
</div>
<div class="fix-10-12">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
</div>
<div class="fix-12-12">
	<ul class="grid">
		<li class="col-<?php echo substr($column_ratio, 0, 1); ?>-12 left">
			<div class="ae-3"><?php the_field('left_side_text', $slide_id); ?>&nbsp;</div>
		</li>
		<li class="col-<?php echo substr($column_ratio, 2, 3); ?>-12 left">
			<div class="ae-3"><?php the_field('right_side_text', $slide_id); ?>&nbsp;</div>
		</li>
	</ul>
</div>











<?php } else if ($slide_type == "single_central_column") { ?>
<div class="fix-10-12">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
<?php
		// partners
		$partners = get_field('icon_grid', $slide_id);
		if (sizeOf($partners) > 0) {
			echo "<ul class='partner-grid'>";
			$column_fraction = floor(12/sizeOf($partners));
			foreach ($partners as $p) {
				$partner_logo = get_field('partner_logo', $p['icon']->ID)['url'];
				$partner_url = get_field('partner_url', $p['icon']->ID);
?>
					<li>
						<a href="<?php echo $partner_url; ?>"><img src='<?php echo $partner_logo; ?>'></a>
					</li>
<?php
			}
			echo "</ul>";
		}
?>
<?php if ($cta_text != "") { ?>
	<a class="button ae-5 fromCenter" href="<?php echo $cta_url; ?>"><?php echo $cta_text; ?></a>
<?php } ?>
</div>







<?php } else if ($slide_type == "double_cta") { ?>
<div class="fix-10-12">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
	<div class="cta-bar">
<?php if ($cta_text != "") { ?>
	<a class="button ae-5 fromCenter" href="<?php echo $cta_url; ?>"><?php echo $cta_text; ?></a>
<?php } ?>
<?php if ($cta_2_text != "") { ?>
	<a class="button ae-5 fromCenter" href="<?php echo $cta_2_url; ?>"><?php echo $cta_2_text; ?></a>
<?php } ?>
	</div>
</div>








<?php } else if ($slide_type == "map") { ?>
<div class="fix-10-12 <?php echo $hero_alignment; ?>">
	<?php echo $title_html; ?>
	<BR><BR><BR><BR><BR><BR><BR><BR><BR>
	<div class="ae-2"><?php echo $slide_content; ?></div>
	<?php if ($cta_position == "above_the_columns") { ?>
		<a class="button ae-5 fromCenter" href="<?php echo $cta_url; ?>"><?php echo $cta_text; ?></a>
	<?php } ?>
</div>

<?php if (sizeOf($columns) > 0) { ?>
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
<?php if ($cta_position == "below_the_columns") { ?>
	<a class="button ae-5 fromCenter" href="<?php echo $cta_url; ?>"><?php echo $cta_text; ?></a>
<?php } ?>








<?php } else if ($slide_type == "three_thumbnails") { ?>
<?php $thumbnails = get_field('thumbnails', $slide_id); ?>
<div class="fix-10-12 <?php echo $hero_alignment; ?>">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
	<?php if ($cta_position == "above_the_columns") { ?>
		<a class="button ae-5 fromCenter" href="<?php echo $cta_url; ?>"><?php echo $cta_text; ?></a>
	<?php } ?>
</div>
<?php if (sizeOf($thumbnails) > 0) { ?>
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
<?php if ($cta_position == "below_the_columns") { ?>
	<a class="button ae-5 fromCenter" href="<?php echo $cta_url; ?>"><?php echo $cta_text; ?></a>
<?php } ?>






<?php } else if ($slide_type == "video") { ?>
<div class="fix-10-12">

	<div class="button play white popupTrigger ae-2 fromCenter button-9" data-popup-id="9"></div>

	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>

</div>









<?php } else { echo "No slide template defined!"; } ?>

			





<?php
			// slide footer
	      	echo '</div></div></div>';
			if ($featured_image != null) echo '<div class="background" style="background-image:url(' . $featured_image . ') !important"></div>';
			echo '</section>';

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
