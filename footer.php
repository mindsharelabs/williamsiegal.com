
	<footer class="footer w-100 pt-3 pb-3">
		<div class="container">
			<div class="row border-top-dark">
				<div class="col-12 mt-1 py-1 copyright text-center">
					<p class="mb-0 small muted"> <i class="fal fa-copyright"></i> <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. All rights reserved.</p>
				</div>
			</div>
		</div>
	</footer>



	<?php if(!is_front_page()) : ?>
		<div class="container mindshare-credit my-2">
			<div class="row">
				<div class="text-center col-8 offset-2 col-md-2 offset-md-5">
					<div class="my-auto text-center">
						<a href="https://mind.sh/are" title="Mindshare Labs, Inc" style="color:#CAA74F">
							<i class="fak fa-2xl fa-mindshare"></i>
						</a>
					</div>
				</div>
			</div>

		</div>
	<?php endif; ?>
<?php

	echo '<nav id="mobileMenu" class="mobile-nav d-block d-md-none">';
		echo '<div class="mobile-logo my-4 mx-auto w-50">';
			echo '<a href="' . home_url() . '">';
				echo '<img src="' . get_template_directory_uri() . '/img/siegal-logo-white.svg" alt="' . get_bloginfo( "name" ) . '" class="logo-img">';
			echo '</a>';
		echo '</div>';
		mindblank_nav('mobile-menu');

		echo '<div class="search-form-mobile w-75 mx-auto py-3">';
			echo '<span class="pb-3 small d-block text-center text-white">SEARCH</span>';
			get_search_form();
		echo '</div>';
	echo '</nav>';

	echo '<nav id="mobileMenuToggle" class="menu-toggle d-flex d-md-none">';
		include get_template_directory() . '/img/menuToggle.svg';
	echo '</nav>';

 ?>


		<?php wp_footer(); ?>
	</body>
</html>
