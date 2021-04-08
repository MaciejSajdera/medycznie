<?php

/*
 * Template Name: Home Page Template
 * description: >-
  Page template without sidebar
 */

global $post;

get_header();
?>
	<aside id="aside-menu">
	<?php
			get_template_part( 'template-parts/shop-menu', 'page' );
		?>
	</aside>

	<main id="primary" class="home-main has-aside--main">
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

		<?php
			// get_template_part( 'template-parts/home-categories-descriptions-random', 'page' );
		?>

		<?php
			get_template_part( 'template-parts/home-brands-showcase', 'page' );
		?>

		<?php
			get_template_part( 'template-parts/home-content-blog', 'page' );
		?>

		</section>

	</main>

	
<?php
get_footer();