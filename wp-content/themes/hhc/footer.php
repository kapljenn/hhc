<?php ?>


<!-- Panel Bottom #01 -->
<nav class="panel bottom forceMobileView">
	<div class="sections desktop">
		<div class="left">
			&copy; Hope and Homes for Children 2016
		</div>
		<div class="center"><span class="nextSlide"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-down"></use></svg></span></div>
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
