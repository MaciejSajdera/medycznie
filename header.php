<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pakistore
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); ?>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PVQS2GD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="my-preloader">
	<div class="preloader-content">
	<?php echo get_custom_logo() ?>
	</div>
</div>

<?php wp_body_open(); ?>
<div id="page" class="site">

	<?php $toppromo = get_field("top_promo", get_option('page_on_front'));
		$isActive = $toppromo['top_promo_active'];
	?>

	<header id="masthead" class="site-header <?php if ($isActive == 1) : echo 'promo-navigation'; endif; ?>">

		<?php

			if ($isActive == 1) :

			echo '<a class="top-promo" href=' .$toppromo['top_promo_link']. '><div class="top-promo-item promo-item-1">' .$toppromo['top_promo_text_1']. '</div> <div class="top-promo-item promo-item-2">  '.$toppromo['top_promo_text_2']. '</div></a>';
			
			endif;
		?>

		<nav id="site-navigation" class="main-navigation">

			<?php
				 get_template_part( 'template-parts/header-top-mobile');
			?>

			<?php
				get_template_part( 'template-parts/header-top-desktop');
			?>




		</nav><!-- #site-navigation -->

		<div class="mobile-menu">

			<div class="mobile-menu__top">

				<div class="site-branding">
					<?php
					the_custom_logo();
					?>
				</div>

				<div class="quick-contact__wrapper">

					<?php
						$phone_number_2 = get_field("phone_number_2", get_page_by_title( 'O nas' ));
					?>
						<a href="tel:<?php echo $phone_number_2;?>"><span class="quick-contact__phone-number"><?php echo $phone_number_2;?></span></a>

					<span class="quick-contact__openings">pn-pt: 8:00 - 16:00</span>
				</div>

			</div>

			<div class="mobile-menu__woomenu">
				<div class="shop-menu">
					<div class="menu-woomenu-container">
						<ul id="menu-woomenu" class="menu">

							<?php
								// wp_nav_menu(
								// 	array(
								// 		'theme_location' => 'wooshop',
								// 	)
								// );
							?>

							<?php wp_nav_menu( array('menu' => 'woomenu', 'items_wrap' => '%3$s', 'container' => false ) ); ?>
							<?php wp_nav_menu( array('menu' => 'menu-1', 'items_wrap' => '%3$s', 'container' => false ) ); ?>

						</ul>
				</div>
			</div>

				<!-- <div class="mobile-menu__site-menu">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'walker'          => new Has_Child_Walker_Nav_Menu()
						)
					);
					?>
				</div> -->

			</div>
			
		</div>

		<div class="desktop-menu">
			
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

							<?php
							
							$facebook_link = get_field("facebook_link", get_page_by_title( 'O nas' ));

							?>
							
							<a href="" target="_blank" class="fixed-icons__icon fixed-ig-icon">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
								<path fill="000" class="st0" d="M15 2.8c4 0 4.4 0 6 0.1 1.4 0.1 2.2 0.3 2.8 0.5 0.7 0.3 1.2 0.6 1.7 1.1 0.5 0.5 0.8 1 1.1 1.7C26.8 6.8 27 7.6 27.1 9c0.1 1.6 0.1 2 0.1 6s0 4.4-0.1 6c-0.1 1.4-0.3 2.2-0.5 2.8 -0.3 0.7-0.6 1.2-1.1 1.7 -0.5 0.5-1 0.8-1.7 1.1 -0.5 0.2-1.3 0.4-2.8 0.5 -1.6 0.1-2 0.1-6 0.1s-4.4 0-6-0.1c-1.4-0.1-2.2-0.3-2.8-0.5 -0.7-0.3-1.2-0.6-1.7-1.1 -0.5-0.5-0.8-1-1.1-1.7C3.2 23.2 3 22.4 2.9 21c-0.1-1.6-0.1-2-0.1-6s0-4.4 0.1-6C3 7.6 3.2 6.8 3.4 6.2 3.7 5.5 4 5.1 4.5 4.5c0.5-0.5 1-0.8 1.7-1.1C6.8 3.2 7.6 3 9 2.9 10.6 2.8 11 2.8 15 2.8M15 0.2c-4 0-4.5 0-6.1 0.1C7.3 0.3 6.2 0.6 5.3 0.9c-1 0.4-1.8 0.9-2.6 1.7C1.8 3.5 1.3 4.3 0.9 5.3c-0.4 0.9-0.6 2-0.7 3.6C0.2 10.5 0.1 11 0.1 15c0 4 0 4.5 0.1 6.1 0.1 1.6 0.3 2.7 0.7 3.6 0.4 1 0.9 1.8 1.7 2.6 0.8 0.8 1.7 1.3 2.6 1.7 0.9 0.4 2 0.6 3.6 0.7 1.6 0.1 2.1 0.1 6.1 0.1s4.5 0 6.1-0.1c1.6-0.1 2.7-0.3 3.6-0.7 1-0.4 1.8-0.9 2.6-1.7 0.8-0.8 1.3-1.7 1.7-2.6 0.4-0.9 0.6-2 0.7-3.6 0.1-1.6 0.1-2.1 0.1-6.1s0-4.5-0.1-6.1c-0.1-1.6-0.3-2.7-0.7-3.6 -0.4-1-0.9-1.8-1.7-2.6 -0.8-0.8-1.7-1.3-2.6-1.7 -0.9-0.4-2-0.6-3.6-0.7C19.5 0.2 19 0.2 15 0.2L15 0.2z"></path>
								<path fill="000" class="st0" d="M15 7.4c-4.2 0-7.6 3.4-7.6 7.6s3.4 7.6 7.6 7.6 7.6-3.4 7.6-7.6S19.2 7.4 15 7.4zM15 20c-2.7 0-5-2.2-5-5s2.2-5 5-5c2.7 0 5 2.2 5 5S17.7 20 15 20z"></path>
								<circle fill="000" class="st0" cx="22.9" cy="7.1" r="1.8"></circle>
								</svg>
							</a>

							<a href="<?php echo $facebook_link ?>" target="_blank" class="fixed-icons__icon">
								<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="30" viewBox="0 0 24 24" width="36"><rect fill="none" height="42" width="36"/><path fill="000" d="M22,12c0-5.52-4.48-10-10-10S2,6.48,2,12c0,4.84,3.44,8.87,8,9.8V15H8v-3h2V9.5C10,7.57,11.57,6,13.5,6H16v3h-2 c-0.55,0-1,0.45-1,1v2h3v3h-3v6.95C18.05,21.45,22,17.19,22,12z"/></svg>
							</a>
					</div>

				</div>

			</div>

		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">