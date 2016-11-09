<?php

/* Page template */

get_header();

while ( have_posts() ) : the_post();

	// loop through the slides in this page...
	if( have_rows('slides') ):

	    while ( have_rows('slides') ) : the_row();

			$slide = get_sub_field('slide');

			// slide ID
			$slide_id = $slide->ID;

			// slide type
			$slide_type = get_field('slide_type', $slide_id);

			// slide palette
			$slide_palette = get_field('slide_palette', $slide_id);

			// slide content
			$slide_content = apply_filters('the_content', $slide->post_content);

			// background image
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($slide_id), 'large' )['0'];

			// title colour
			$title_colour = get_field('title_colour', $slide_id);

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







<?php if ($slide_type == "header_with_3_columns") { ?>
<div class="fix-10-12 toCenter">
	<h1 class="ae-1" style="color: <?php echo $title_colour; ?>"><?php echo $slide->post_title; ?></h1>
	<div class="ae-2"><?php echo $slide_content; ?></div>
</div>
<div class="fix-12-12">
	<ul class="grid later equal">
		<li class="col-4-12">
			<div class="fix-4-12">
				<img src="#">
				<h3 class="equalElement ae-7">Meet Quick</h3>
				<div class="ae-8"><p class="small">Space and light and order. Those are the things that men.</p></div>
			</div>
		</li>
		<li class="col-4-12">
			<div class="fix-4-12">
				<img src="#">
				<h3 class="equalElement ae-8">Nice Experience</h3>
				<div class="ae-9"><p class="small">Space and light and order. Those are the things that men.</p></div>
			</div>
		</li>
		<li class="col-4-12">
			<div class="fix-4-12">  
				<img src="#">
				<h3 class="equalElement ae-9">Simple Beauty</h3>
				<div class="ae-10"><p class="small">Space and light and order. Those are the things that men.</p></div>
			</div>
		</li>
	</ul>
</div>

<?php } else if ($slide_type == "header_with_4_columns") { ?>
<div class="fix-10-12 toCenter">
	<h1 class="ae-1" style="color: <?php echo $title_colour; ?>"><?php echo $slide->post_title; ?></h1>
	<div class="ae-2"><?php echo $slide_content; ?></div>
</div>
<div class="fix-12-12">
	<ul class="grid later equal">
		<li class="col-3-12">
			<div class="fix-3-12">
				<img src="#">
				<h3 class="equalElement ae-7">Meet Quick</h3>
				<div class="ae-5">Here is some column text.</div>
			</div>
		</li>
		<li class="col-3-12">
			<div class="fix-3-12">
				<img src="#">
				<h3 class="equalElement ae-8">Nice Experience</h3>
				<div class="ae-6">Here is some column text.</div>
			</div>
		</li>
		<li class="col-3-12">
			<div class="fix-3-12">  
				<img src="#">
				<h3 class="equalElement ae-9">Simple Beauty</h3>
				<div class="ae-7">Here is some column text.</div>
			</div>
		</li>
		<li class="col-3-12">
			<div class="fix-3-12">  
				<img src="#">
				<h3 class="equalElement ae-10">Simple Beauty</h3>
				<div class="ae-8">Here is some column text.</div>
			</div>
		</li>
	</ul>
</div>

<?php } else if ($slide_type == "side_by_side_with_image") { ?>
<?php
	
	$image_alignment = get_field('image_alignment', $slide_id);
	$image = get_field('image', $slide_id);
	
?>
<div class="<?php echo $image_alignment; ?>-hand-image">
	<img class="shiftImage shiftImageVertical" src="<?php echo $image['url']; ?>" width="1200" alt="<?php echo $image['url']; ?>"/>
</div>
<div class="fix-12-12">
	<ul class="grid">

		<?php if ($image_alignment == "left") { ?><li class="col-6-12 left" data-action="zoom">&nbsp;</li><?php } ?>
		<li class="col-6-12 left">
			<h1 class="ae-2" style="color: <?php echo $title_colour; ?>"><?php echo $slide->post_title; ?></h1>
			<div class="ae-3"><?php echo $slide_content; ?></div>
		</li>
		<?php if ($image_alignment == "right") { ?><li class="col-6-12 left" data-action="zoom">&nbsp;</li><?php } ?>
	</ul>
</div>
        
<?php } else if ($slide_type == "single_central_column") { ?>
<div class="fix-10-12">
	<h1 class="ae-1" style="color: <?php echo $title_colour; ?>"><?php echo $slide->post_title; ?></h1>
	<div class="ae-2"><?php echo $slide_content; ?></div>
	<a class="button ae-5 fromCenter" href="<?php echo $cta_url; ?>"><?php echo $cta_text; ?></a>
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

<section class="slide fade kenBurns footer"><div class="content"><div class="container"><div class="wrap">
	<div class="fix-12-12">
		<ul class="grid later equal">
			<li class="col-3-12">
				<div class="fix-3-12">
					<h3 class="equalElement ae-7">Lorem Ipsum</h3>
					<div class="ae-5">Here is some column text.</div>
				</div>
			</li>
			<li class="col-3-12">
				<div class="fix-3-12">
					<h3 class="equalElement ae-8">Lorem Ipsum</h3>
					<div class="ae-6">Here is some column text.</div>
				</div>
			</li>
			<li class="col-3-12">
				<div class="fix-3-12">  
					<h3 class="equalElement ae-9">Lorem Ipsum</h3>
					<div class="ae-7">Here is some column text.</div>
				</div>
			</li>
			<li class="col-3-12">
				<div class="fix-3-12">
					<h3 class="equalElement ae-10">Lorem Ipsum</h3>
					<div class="ae-8">Here is some column text.</div>
				</div>
			</li>
		</ul>
	</div>
	<div class="fix-10-12 toCenter">
		<br><br><br><br>
		<h3 class="equalElement ae-10">Follow us</h3>
		<ul class="social ae-9">
			<li>
				<a href="#">
					<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/facebook.png" />
				</a>
			</li>
			<li>
				<a href="#">
					<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/twitter.png" />
				</a>
			</li>
			<li>
				<a href="#">
					<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/instagram.png" />
				</a>
			</li>
		</ul>
	</div>
</section>






<?php


get_footer();

?>
