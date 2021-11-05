<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package medycznie
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header class="entry-header common-template">
					<?php single_post_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<?php
			endif;
			
			?> <div class="blog-grid"> <?php
			/* Start the Loop */
			while ( have_posts() ) :

				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */

				// echo "<div class='post-wrapper'>";

				// 	echo "<div class='post-upper-wrapper'>";
				// 			echo '<a class="blog-post" href="'. get_permalink() .'" style="background-image: url(' .get_the_post_thumbnail_url(). ')">';

				// 			echo '<div class="blog-post__text">';
				// 			echo '<h3 class="uppercase">' . get_the_title() . '</h3>';
				// 			echo '</div>';
				// 			echo '</a>';

				// 	echo "</div>";

				// the_excerpt();

				// echo "</div>";

				echo '<a class="blog-post" href="'. get_permalink() .'">';

					echo '<div class="blog-post__image" style="background-image: url('.esc_url(get_the_post_thumbnail_url()).')"></div>';

					echo '<div class="blog-post__text">';
						echo '<p>' . get_the_title() . '<span>'.get_the_date().'</span></p>';
						echo '<p>' .  mb_strimwidth( html_entity_decode(get_the_excerpt()), 0, 240, '...' ) . '</p>';
					echo '</div>';

			 	echo '</a>';

			endwhile;

			?>		</div><!-- blog-grid --> <?php

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
