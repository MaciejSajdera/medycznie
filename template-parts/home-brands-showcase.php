<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package evenus
 */

?>

<section class="brands-carousel blog-posts-header">
	<h3>Marki</h3>
  <div class="swiper-container-brands">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
	<?php 
		$parent_id = 26;
		$orderby = 'name';
		$order = 'asc';
		$hide_empty = false ;
		$cat_args = array(
			'orderby'    => $orderby,
			'order'      => $order,
			'hide_empty' => $hide_empty,
			'parent' => $parent_id
		);
		
		$product_categories = get_terms( 'product_cat', $cat_args );
		
		if( !empty($product_categories) ){

			foreach ($product_categories as $key => $category) {

				$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_url( $thumbnail_id );

				if ($image) {

				echo '<div class="swiper-slide">';

				echo '<a href="'.get_term_link($category).'" >';
				echo '<img src="'.$image.'">';
				echo '</a>';
				echo '</div>';
				};
			}

		}
		?>
	</div>
  </div>
</section>
