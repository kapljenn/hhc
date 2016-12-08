<?php ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<title><?php wp_title(); ?></title>
	<?php wp_head(); ?>
</head>

<?php
	// use small text?
	$body_classes = 'slides fast smooth film whiteSlide animated scroll';
	if (get_field('small_text')) $body_classes = $body_classes . " small-text";
	if (is_single()) {
		$obj = get_queried_object();
 		$cpt = $obj->post_type;
		if ($cpt != 'slide') $body_classes = $body_classes . " small-text";
	}
?>

<body <?php body_class($body_classes); ?>>
	<script type="text/javascript">
	// save variables for use in JS
	var site_url = "<?php echo site_url() ?>";
	var home_url = "<?php echo home_url() ?>";
	var stylesheet_dir = "<?php echo esc_url( get_template_directory_uri() ); ?>";
	var ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>

<?php require(get_template_directory().'/includes/svg.php'); ?>

<!-- Navigation -->
<nav class="side">
	<div class="navigation">
		<ul></ul>
	</div>
</nav>

<!-- Panel top #20 -->
<nav class="panel top forceMobileView">
	<div class="sections desktop">
		<div class="left">
			<a href="<?php echo home_url() ?>">
				<img class="logo" alt="logo" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/logo.png" />
				<img class="logo inverted" alt="logo" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/logo-inverted.png" />
			</a>
		</div>
		<div class="center">
			<?php wp_nav_menu( array('menu' => 'Main', 'menu_class' => 'menu uppercase')); ?>
		</div>
		<div class="right">
			<a class="button menuButton" href="<?php echo site_url() . '/fundraise/' ?>">Fundraise</a>
			<a class="button menuButton" href="<?php echo site_url()  . '/donate/' ?>">Donate</a>
		</div>
	</div>
	<div class="sections compact hidden">
		<div class="left">
			<a href="#">
				<img class="logo" alt="logo" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/logo.png" />
				<img class="logo inverted" alt="logo" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/logo-inverted.png" />
			</a>
		</div>
		<div class="right"><span class="button actionButton sidebarTrigger" data-sidebar-id="1"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu"></use></svg></span></div>
	</div>
</nav>

<!-- Sidebar -->
<nav class="sidebar deepPurple" data-sidebar-id="1">
	<div class="close"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close"></use></svg></div>
	<div class="content">
		<a href="#" class="logo"><svg width="120" height="50"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo"></use></svg></a>
		<?php wp_nav_menu( array('menu' => 'Main', 'menu_class' => 'mainMenu uppercase')); ?>
		<ul class="main-menu-add-on">
			<li>
				<a href="<?php echo site_url() ?>/fundraise/">Fundraise</a>
			</li>
			<li>
				<a href="<?php echo site_url() ?>/donate/">Donate</a>
			</li>
		</ul>
		<?php wp_nav_menu( array('menu' => 'Corporate', 'menu_class' => 'subMenu')); ?>
		<ul class="social">
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
</nav>

