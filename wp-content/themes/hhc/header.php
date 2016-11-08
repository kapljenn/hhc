<?php ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes" />

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

	<title><?php wp_title(); ?></title>
	<?php wp_head(); ?>

</head>

<body <?php body_class('slides film whiteSlide animated'); ?>>

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
			<a href="#">
				<img class="logo" alt="logo" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/logo.png" />
				<img class="logo inverted" alt="logo" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/logo-inverted.png" />
			</a>
		</div>
		<div class="center">
			<?php wp_nav_menu( array('menu' => 'Main', 'menu_class' => 'menu uppercase')); ?>
		</div>
		<div class="right"><a class="button menuButton" href="#">Fundraise</a><a class="button menuButton" href="#">Donate</a></div>
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
		<ul class="subMenu">
			<li><a href="#">About Us</a></li>
			<li><a href="#">Terms of Use</a></li>
			<li><a href="#">Privacy Policy</a></li>
		</ul>
		<ul class="social">
			<li><a href="#"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#twitter"></use></svg></a></li>
			<li><a href="#"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#facebook"></use></svg></a></li>
			<li><a href="#"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#googlePlus"></use></svg></a></li>
			<li><a href="#"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#pinterest"></use></svg></a></li>
		</ul>
	</div>
</nav>

