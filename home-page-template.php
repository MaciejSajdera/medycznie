<?php

/*
 * Template Name: Home Page Template
 * description: >-
  Page template without sidebar
 */

global $post;

get_header();
$h1 = get_field('h1');
?>

	<div class="home-top-mobile">

		<div class="site-branding">
			<?php
			the_custom_logo();
			?>
		</div><!-- .site-branding -->

		<div class="quick-contact__wrapper">

			<?php
				$phone_number_2 = get_field("phone_number_2", get_page_by_title( 'O nas' ));
			?>
				<a href="tel:<?php echo $phone_number_2;?>"><span class="quick-contact__phone-number"><?php echo $phone_number_2;?></span></a>

			<span class="quick-contact__openings">pn-pt: 8:00 - 16:00</span>
		</div>

	</div>

	<div class="home-main">

		<h1 class="home-main__h1"><?php echo $h1 ?></h1>

		<div class="home-main__top-wrapper">

			<?php
				get_template_part( 'template-parts/shop-menu', 'page' );
			?>

			<div class="has-aside--main">

				<?php
					get_template_part( 'template-parts/special-categories-menu', 'page' );
				?>

				<div class="welcome-view">
					<?php
						get_template_part( 'template-parts/home-carousel', 'page' );
					?>

					<?php
						get_template_part( 'template-parts/home-advantages', 'page' );
					?>
				</div>
				
				<?php
					get_template_part( 'template-parts/home-categories-display', 'page' );
				?>

			</div>

		</div>

		<?php
				get_template_part( 'template-parts/home-brands-showcase', 'page' );
		?>

		<?php
				// get_template_part( 'template-parts/home-content-blog', 'page' );
		?>

</div>

	
<?php
get_footer();