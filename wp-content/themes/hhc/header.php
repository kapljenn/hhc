<?php ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<title><?php wp_title(); ?></title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<script type="text/javascript">
	// save variables for use in JS
	var site_url = "<?php echo site_url() ?>";
	var home_url = "<?php echo home_url() ?>";
	var stylesheet_dir = "<?php echo esc_url( get_template_directory_uri() ); ?>";
    var ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>

<div class="wrapper">

	<div class="page-content">