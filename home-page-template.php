<?php

/*
 * Template Name: Home Page Template
 * description: >-
  Page template without sidebar
 */

global $post;

get_header();
?>

	<div class="home-main">

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
					// get_template_part( 'template-parts/home-advantages', 'page' );
				?>
				</div>
				
				<?php
					get_template_part( 'template-parts/home-categories-display', 'page' );
				?>

				<?php
					// get_template_part( 'template-parts/home-categories-descriptions-random', 'page' );
				?>

			</div>

		</div>

		<?php
				get_template_part( 'template-parts/home-brands-showcase', 'page' );
		?>

		<?php
				get_template_part( 'template-parts/home-content-blog', 'page' );
		?>


</div>

	
<?php
get_footer();