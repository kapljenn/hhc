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

			// slide content
			$slide_content = apply_filters('the_content', $slide->post_content);

			// background image
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($slide_id), 'large' )['0'];

			// CTA
			$cta_text = get_field('cta_text', $slide_id);
			$cta_url = get_field('cta_url', $slide_id);

			// slide classes
			$slide_classes = "fade kenBurns ";
			if ($slide_palette == "dark_text_white_background") $slide_classes = "whiteSlide ";
			if ($slide_palette == "dark_text_grey_background") $slide_classes = "whiteSlide greyTint";
			$slide_classes .= $slide_type;

			// slide header
			echo '<section class="slide ' . $slide_classes . '"><div class="content"><div class="container"><div class="wrap">';

?>









<?php if ( ($slide_type == "header_with_3_columns") || ($slide_type == "header_with_4_columns") ) { ?>
<?php
	$hero_alignment = get_field('hero_alignment', $slide_id);
	$columns = get_field('columns', $slide_id);
	$cta_position = get_field('cta_position', $slide_id);
?>
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











<?php } else if ($slide_type == "side_by_side_with_image") { ?>
<?php
	$image_alignment = get_field('image_alignment', $slide_id);
	$image = get_field('image', $slide_id);
?>
<div class="<?php echo $image_alignment; ?>-hand-image">
	<img class="shiftImage shiftImageVertical" src="<?php echo $image['url']; ?>" width="1200" alt="<?php echo $image['alt']; ?>"/>
</div>
<div class="fix-12-12">
	<ul class="grid">
		<?php if ($image_alignment == "left") { ?><li class="col-6-12 left" data-action="zoom">&nbsp;</li><?php } ?>
		<li class="col-6-12 left">
			<?php echo $title_html; ?>
			<div class="ae-3"><?php echo $slide_content; ?></div>
		</li>
		<?php if ($image_alignment == "right") { ?><li class="col-6-12 left" data-action="zoom">&nbsp;</li><?php } ?>
	</ul>
</div>











<?php } else if ($slide_type == "single_central_column") { ?>
<div class="fix-10-12">
	<?php echo $title_html; ?>
	<div class="ae-2"><?php echo $slide_content; ?></div>
<?php if ($cta_text != "") { ?>
	<a class="button ae-5 fromCenter" href="<?php echo $cta_url; ?>"><?php echo $cta_text; ?></a>
<?php } ?>
</div>








<?php } else { echo "No slide template defined!"; } ?>

			





<?php
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
?>




<?php

get_footer();

?>
