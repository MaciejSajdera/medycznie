<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package medycznie
 */

?>

<section class="brands-carousel blog-posts-header reveal-from__trigger">

	<div class="reveal-from__element reveal-from--bottom">

		<p class="section-header">Nasi dostawcy</p>

		<div class="swiper-container-brands">
			<!-- Additional required wrapper -->
			<div class="swiper-wrapper">
				<!-- Slides -->
			<?php 

					// Get the taxonomy's terms
					$terms = get_terms(
						array(
							'taxonomy'   => 'manufacturer',
							'hide_empty' => false,
						)
					);

					// Check if any term exists
					if ( ! empty( $terms ) && is_array( $terms ) ) {
						// Run a loop and print them all
						foreach ( $terms as $term ) {
							$imageURL = get_field("producent_logo", $term);

						if ($imageURL) {

							echo '<div class="swiper-slide">';

							echo '<a href="'.esc_url( get_term_link( $term ) ).'" >';
							echo '<img width="150" height="auto" src="'.$imageURL.'" alt="'.$term->name.'" loading="lazy">';
							echo '</a>';
							echo '</div>';
							};
						}
					} 

				?>
			</div>
		</div>

	</div>
</section>
