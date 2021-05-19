<aside id="aside-menu">
	<div class="shop-menu">
					<!-- <div class="mobile-list-title">
						<span>Oferta</span>
					</div> -->

						<!-- this wooshoop menu is only for desktop -->
						<?php
									wp_nav_menu(
										array(
											'theme_location' => 'wooshop',
										)
									);
						?>
	</div>

	<?php
		get_template_part( 'template-parts/home-advantages', 'page' );
	?>
</aside>