<?php ?>

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


<!-- Panel Bottom #01 -->
<nav class="panel bottom forceMobileView">
	<div class="sections desktop">
		<div class="left">
			&copy; Hope and Homes for Children 2016
		</div>
		<div class="center">
			<span class="nextSlide">
				<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/down-arrow.png" />
			</span>
		</div>
		<div class="right">
			<?php wp_nav_menu( array('menu' => 'Legal', 'menu_class' => 'menu')); ?>
		</div>
	</div>
	<div class="sections compact hidden">
		<div class="right"></div>
	</div>
</nav>

<!-- Share Window -->
<div class="dropdown share bottom right hidden" data-dropdown-id="2" data-text="Take a look at this" data-url="http://designmodo.com" data-pinterest-image="http://designmodo.com/wp-content/uploads/2015/10/Presentation.jpg">
	<h3>Share</h3>
	<ul>
		<li class="facebook">
			<a href="#">
				<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/facebook.png" />
			</a>
		</li>
		<li class="twitter">
			<a href="#">
				<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/twitter.png" />
			</a>
		</li>
		<li class="instagram">
			<a href="#">
				<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/instagram.png" />
			</a>
		</li>
	</ul>
</div>

<!-- Preloader -->
<div class="loadingIcon"><svg class="loading-icon" id="loading-circle" viewBox="0 0 18 18"><circle class="circle" opacity=".1" stroke="#fff" stroke-width="2" stroke-miterlimit="10" cx="9" cy="9" r="8" fill="none"></circle><circle class="dash" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" stroke-dasharray="1,100" cx="9" cy="9" r="8" fill="none"></circle></svg></div>

<?php wp_footer(); ?>

</body>
</html>
