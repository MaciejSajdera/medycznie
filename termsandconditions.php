<?php
/*
 * Template Name: Terms and Conditions Template
 * description: >-
  Page template without sidebar
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<?php
		while ( have_posts() ) :
			the_post();

			the_content();

			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

		endwhile; // End of the loop.
		?>

		<?php

			if (is_page( 213 )) :

				$return_product_form = get_field("return_product_form");

				echo '<div
				style="
				display: flex;
				flex-flow: column;
				justify-content: center;
				align-items: center;
				">';

					echo '<p>FORMULARZ ODSTĄPIENIA OD UMOWY</p>';

					echo '<a href="'.$return_product_form.'" class="button product_type_simple add_to_cart_button"
					style="
					padding: 1em 2em;
					margin: auto;
					max-width: 300px;
					display: block;
					text-decoration: none;
					">
					Pobierz 
					</a>';

				echo '</div>';

			endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
