<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package medycznie
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="my-preloader">
	<div class="preloader-content"></div>
</div>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'medycznie' ); ?></a>

	<?php $toppromo = get_field("top_promo", get_option('page_on_front'));
		$isActive = $toppromo['top_promo_active'];
	?>

	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="main-navigation <?php if ($isActive == 1) : echo 'promo-navigation'; endif; ?>">

			<?php

				if ($isActive == 1) :

				   echo '<a class="top-promo" href=' .$toppromo['top_promo_link']. '><div class="top-promo-item promo-item-1">' .$toppromo['top_promo_text_1']. '</div> <div class="top-promo-item promo-item-2">  '.$toppromo['top_promo_text_2']. '</div></a>';
				   
				endif;
			?>

			<div class="shop-nav-wrapper">

				<div class="search-icon-wrapper">
					<div id="search-icon" class="wrapper-flex-column">
						<svg xmlns="http://www.w3.org/2000/svg" class="shop-icon" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path fill="#ccc" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
						<span class="search-sub-icon-text sub-icon-text">Szukaj</span>
					</div>
				</div>


				<!-- <div class="store-desktop ">
					<a id="store-icon" class="wrapper-flex-column" href="<?php echo get_permalink( get_option( 'woocommerce_shop_page_id' ) ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" class="shop-icon" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path fill="#ccc" d="M20 4H4v2h16V4zm1 10v-2l-1-5H4l-1 5v2h1v6h10v-6h4v6h2v-6h1zm-9 4H6v-4h6v4z"/></svg>
					<span class="sub-icon-text">Sklep</span>
					</a>
				</div> -->


				<?php 
				if (is_user_logged_in()) : 
				?><div class="myaccount "><a class="myaccount-link-logged wrapper-flex-column" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>">
									<svg xmlns="http://www.w3.org/2000/svg" class="shop-icon" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path fill="#6488b9" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>

				<span class="sub-icon-text">Konto</span></a></div><?php
				else :
				?><div class="myaccount "><a class="myaccount-link-unlogged wrapper-flex-column" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" class="shop-icon" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><path fill="#ccc" d="M11,7L9.6,8.4l2.6,2.6H2v2h10.2l-2.6,2.6L11,17l5-5L11,7z M20,19h-8v2h8c1.1,0,2-0.9,2-2V5c0-1.1-0.9-2-2-2h-8v2h8V19z"/></g></svg>

				<span class="sub-icon-text sub-login">Login / Rejestracja</span></a></div><?php
				endif;
				?>

				<!-- html below is a placeholder, <a> content renders from functions.php function -->
				<a class="cart-customlocation">
					<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						width="446.843px" height="446.843px" viewBox="0 0 446.843 446.843" style="enable-background:new 0 0 446.843 446.843;"
						xml:space="preserve">
					<g>
						<path fill="#ccc" d="M444.09,93.103c-2.698-3.699-7.006-5.888-11.584-5.888H155.321c-7.92,0-14.337,6.417-14.337,14.337
							s6.417,14.337,14.337,14.337h257.537l-10.338,32.259H186.782c-7.92,0-14.337,6.417-14.337,14.337
							c0,7.92,6.417,14.337,14.337,14.337h206.543l-11.868,37.038H203.509c-7.92,0-14.337,6.417-14.337,14.34
							c0,7.92,6.417,14.337,14.337,14.337h168.759l-9.955,31.064H172.692L94.794,49.064c-1.376-3.958-4.406-7.113-8.3-8.646
							L19.586,14.134c-7.374-2.887-15.695,0.735-18.591,8.1c-2.891,7.369,0.73,15.695,8.1,18.591l60.768,23.872l74.381,214.399
							c-3.283,1.144-6.065,3.663-7.332,7.187l-21.506,59.739c-1.318,3.663-0.775,7.733,1.468,10.916c2.24,3.183,5.883,5.078,9.773,5.078
							h11.044c-6.844,7.616-11.044,17.646-11.044,28.675c0,23.718,19.298,43.012,43.012,43.012s43.012-19.294,43.012-43.012
							c0-11.029-4.2-21.059-11.044-28.675h93.776c-6.847,7.616-11.048,17.646-11.048,28.675c0,23.718,19.294,43.012,43.013,43.012
							c23.718,0,43.012-19.294,43.012-43.012c0-11.029-4.2-21.059-11.043-28.675h13.433c6.599,0,11.947-5.349,11.947-11.948
							c0-6.599-5.349-11.947-11.947-11.947H143.647l13.319-36.996c1.72,0.724,3.578,1.152,5.523,1.152h210.278
							c6.234,0,11.751-4.027,13.65-9.959l59.739-186.387C447.557,101.567,446.788,96.802,444.09,93.103z M169.659,409.807
							c-10.543,0-19.116-8.573-19.116-19.116s8.573-19.117,19.116-19.117s19.116,8.574,19.116,19.117S180.202,409.807,169.659,409.807z
							M327.367,409.807c-10.543,0-19.117-8.573-19.117-19.116s8.574-19.117,19.117-19.117c10.542,0,19.116,8.574,19.116,19.117
							S337.909,409.807,327.367,409.807z"/>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					<g>
					</g>
					</svg>
					<span class="woocommerce-Price-amount amount sub-icon-text"><bdi>0,00<span class="woocommerce-Price-currencySymbol">zł</span></bdi></span>
				</a>

				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html( 'Primary Menu', 'medycznie' ); ?>
					<svg id="svgButton" class="ham hamRotate ham4" viewBox="0 0 100 100">
					<path
							class="line top"
							d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20" />
					<path
							class="line middle"
							d="m 70,50 h -40" />
					<path
							class="line bottom"
							d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20" />
					</svg>
				</button>

			</div>









			<?php
// Reset the WP Query
wp_reset_postdata();

?>
		</nav><!-- #site-navigation -->

		<div class="header-middle">

				<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$medycznie_description = get_bloginfo( 'description', 'display' );
				if ( $medycznie_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $medycznie_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
				</div><!-- .site-branding -->

				<div class="search-panel">
					<?php echo do_shortcode('[fibosearch]'); ?>
				</div>


				<div class="quick-contact__wrapper">
					<a href="tel:123456789"><span class="quick-contact__phone-number">+48 123 456 789</span></a>
					<span class="quick-contact__openings">pn-pt: 8:00 - 16:00</span>
				</div>
				
			</div>

			<div class="site-menu site-menu-desktop">

				<div class="site-menu__wrapper">
				<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'walker'          => new Has_Child_Walker_Nav_Menu()
							)
						);
					?>

					<div class="social-media">
							
							<a href="" target="_blank" class="fixed-icons__icon fixed-ig-icon">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
								<path fill="000" class="st0" d="M15 2.8c4 0 4.4 0 6 0.1 1.4 0.1 2.2 0.3 2.8 0.5 0.7 0.3 1.2 0.6 1.7 1.1 0.5 0.5 0.8 1 1.1 1.7C26.8 6.8 27 7.6 27.1 9c0.1 1.6 0.1 2 0.1 6s0 4.4-0.1 6c-0.1 1.4-0.3 2.2-0.5 2.8 -0.3 0.7-0.6 1.2-1.1 1.7 -0.5 0.5-1 0.8-1.7 1.1 -0.5 0.2-1.3 0.4-2.8 0.5 -1.6 0.1-2 0.1-6 0.1s-4.4 0-6-0.1c-1.4-0.1-2.2-0.3-2.8-0.5 -0.7-0.3-1.2-0.6-1.7-1.1 -0.5-0.5-0.8-1-1.1-1.7C3.2 23.2 3 22.4 2.9 21c-0.1-1.6-0.1-2-0.1-6s0-4.4 0.1-6C3 7.6 3.2 6.8 3.4 6.2 3.7 5.5 4 5.1 4.5 4.5c0.5-0.5 1-0.8 1.7-1.1C6.8 3.2 7.6 3 9 2.9 10.6 2.8 11 2.8 15 2.8M15 0.2c-4 0-4.5 0-6.1 0.1C7.3 0.3 6.2 0.6 5.3 0.9c-1 0.4-1.8 0.9-2.6 1.7C1.8 3.5 1.3 4.3 0.9 5.3c-0.4 0.9-0.6 2-0.7 3.6C0.2 10.5 0.1 11 0.1 15c0 4 0 4.5 0.1 6.1 0.1 1.6 0.3 2.7 0.7 3.6 0.4 1 0.9 1.8 1.7 2.6 0.8 0.8 1.7 1.3 2.6 1.7 0.9 0.4 2 0.6 3.6 0.7 1.6 0.1 2.1 0.1 6.1 0.1s4.5 0 6.1-0.1c1.6-0.1 2.7-0.3 3.6-0.7 1-0.4 1.8-0.9 2.6-1.7 0.8-0.8 1.3-1.7 1.7-2.6 0.4-0.9 0.6-2 0.7-3.6 0.1-1.6 0.1-2.1 0.1-6.1s0-4.5-0.1-6.1c-0.1-1.6-0.3-2.7-0.7-3.6 -0.4-1-0.9-1.8-1.7-2.6 -0.8-0.8-1.7-1.3-2.6-1.7 -0.9-0.4-2-0.6-3.6-0.7C19.5 0.2 19 0.2 15 0.2L15 0.2z"></path>
								<path fill="000" class="st0" d="M15 7.4c-4.2 0-7.6 3.4-7.6 7.6s3.4 7.6 7.6 7.6 7.6-3.4 7.6-7.6S19.2 7.4 15 7.4zM15 20c-2.7 0-5-2.2-5-5s2.2-5 5-5c2.7 0 5 2.2 5 5S17.7 20 15 20z"></path>
								<circle fill="000" class="st0" cx="22.9" cy="7.1" r="1.8"></circle>
								</svg>
							</a>

							<a href="" target="_blank" class="fixed-icons__icon">
								<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="30" viewBox="0 0 24 24" width="36"><rect fill="none" height="42" width="36"/><path fill="000" d="M22,12c0-5.52-4.48-10-10-10S2,6.48,2,12c0,4.84,3.44,8.87,8,9.8V15H8v-3h2V9.5C10,7.57,11.57,6,13.5,6H16v3h-2 c-0.55,0-1,0.45-1,1v2h3v3h-3v6.95C18.05,21.45,22,17.19,22,12z"/></svg>
							</a>
					</div>

				</div>


			</div>

		<div class="mobile-menu">
						<div class="mobile-menu__site-menu">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'walker'          => new Has_Child_Walker_Nav_Menu()
								)
							);
							?>
						</div>

						<div class="mobile-menu__woomenu">
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
						</div>
			</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">