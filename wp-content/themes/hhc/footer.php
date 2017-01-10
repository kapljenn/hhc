<?php ?>

<section class="slide fade kenBurns footer"><div class="content"><div class="container"><div class="wrap">
	<div class="fix-12-12">
		<?php wp_nav_menu( array('menu' => 'Corporate', 'menu_class' => '')); ?>
	</div>
	<div class="fix-12-12">
		<?php wp_nav_menu( array('menu' => 'Legal', 'menu_class' => '')); ?>
	</div>
	<div class="fix-10-12 toCenter">
		<br>
		<h3 class="equalElement ae-10" style="color: #fff;">Follow us</h3>
		<ul class="social ae-9">
			<li>
				<a target="_blank" href="http://www.facebook.com/hopeandhomes">
					<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/facebook.png" />
				</a>
			</li>
			<li>
				<a target="_blank" href="https://twitter.com/HopeandHomes">
					<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/twitter.png" />
				</a>
			</li>
			<li>
				<a target="_blank" href="https://www.instagram.com/hopeandhomesforchildren/">
					<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/instagram.png" />
				</a>
			</li>
		</ul>
		<div class="copyright">
			<!--
			<a class="frsb" href="http://www.frsb.org.uk/">
				<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/frsb.png" />
			</a>
			<br>
			-->
			&copy; Hope and Homes for Children 2016<br>
			Hope and Homes for Children is a registered charity. No 1089490
		</div>
	</div>
</section>



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
