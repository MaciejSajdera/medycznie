<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<div class="woocommerce-archive__wrapper">

		<?php
			get_template_part( 'template-parts/shop-menu', 'page' );
		?>

	<div class="woocommerce-archive__right-column">

		<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
		
			<div class="product_title__wrapper">

				<?php
					do_action( 'my_woocommerce_before_single_product' );
				?>

			</div>

			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>

			<div class="summary entry-summary">

				<?php

				/** Product Info Table */

				
				// add_filter( 'woocommerce_quantity_input_args', 'custom_quantity_input_args', 20, 2 );
				// function custom_quantity_input_args( $args, $product ) {
				// 	if( $product->get_stock_quantity() == 1 && is_product() ){
				// 		$args['max_value'] = '1';
						
				// 	}
				// 	return $args;
				// }

				// $availbility_status;

				// if( $product->is_in_stock() && !$product->get_stock_quantity() ) {
				// 	$availbility_status = '<span class="product-available">Dostępne</span>';		
				// }

				// elseif( $product->is_in_stock() && $product->get_stock_quantity() < 10 ) {
				// 	$availbility_status = '<span class="product-low-stock">'. $product->get_stock_quantity() .'szt.</span>';		
				// }

				// elseif( $product->is_in_stock() && $product->get_stock_quantity() ) {
				// 	$availbility_status = '<span class="product-available">'. $product->get_stock_quantity() .'szt.</span>';	
				// }
				
				// else {
				// 	$availbility_status = '<span class="product-notavailable">Niedostępne</span>';
				// }

				// echo '<div class="product-info"><div class="product-info__label">Stan magazynowy:</div><div class="product-info__value">'.$availbility_status.'</div></div>';

				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>

			<?php
			/**
			 * Hook: woocommerce_after_single_product_summary.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
			?>

		</div>
		
	</div>	<!-- woocommerce-archive__right-column -->
</div> <!-- woocommerce-archive__wrapper -->

<?php do_action( 'woocommerce_after_single_product' );
