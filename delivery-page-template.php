<?php

/*
 * Template Name: Delivery Page Template
 * description: >-
  Page template without sidebar
 */

global $post;

$delivery_option_2 = get_field('delivery_option_2', get_option( 'woocommerce_cart_page_id' ) );
$delivery_option_3 = get_field('delivery_option_3', get_option( 'woocommerce_cart_page_id' ) );
$delivery_option_4 = get_field('delivery_option_4', get_option( 'woocommerce_cart_page_id' ) );
$delivery_option_5 = get_field('delivery_option_5', get_option( 'woocommerce_cart_page_id' ) );
$delivery_option_6 = get_field('delivery_option_6', get_option( 'woocommerce_cart_page_id' ) );


// $rate_table = array();

// $shipping_methods = WC()->shipping->get_shipping_methods();

// foreach($shipping_methods as $shipping_method){
//     $shipping_method->init();

//     foreach($shipping_method->rates as $key=>$val)
//         $rate_table[$key] = $val->label;
// }


get_header();
?>

	<div class="home-main">

		<div class="home-main__top-wrapper">

			<?php
				get_template_part( 'template-parts/shop-menu', 'page' );
			?>

			<div class="has-aside--main">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						// if ( comments_open() || get_comments_number() ) :
						// 	comments_template();
						// endif;

						echo '<div class="delivery-data">';

							echo '<h2>Cennik</h2>';

							echo '<div class="delivery-data__all-options">';

									$i = 0;

									// Get all your existing shipping zones IDS
										$zone_ids = array_keys( array('') + WC_Shipping_Zones::get_zones() );

										// Loop through shipping Zones IDs
										foreach ( $zone_ids as $zone_id ) 
										{
											// Get the shipping Zone object
											$shipping_zone = new WC_Shipping_Zone($zone_id);

											// Get all shipping method values for the shipping zone
											$shipping_methods = $shipping_zone->get_shipping_methods( true, 'values' );

											// Loop through each shipping methods set for the current shipping zone
											// FIRST 2 METHODS SKIPPED (FREE SHIPPING)
											foreach ( array_slice($shipping_methods, 2) as $instance_id => $shipping_method ) 
											{
												
												// var_dump($shipping_method);

												echo '<div class="delivery-data__option delivery-data__option--'.$i.'">';

													echo '<img src="'.$shipping_method->instance_settings['shipping_method_image'].'" />';
													echo '<p>'.$shipping_method->instance_settings['title'].'</p>';

													$shipping_cost_integer = str_replace(',', '.', $shipping_method->instance_settings['cost']);

													$shipping_with_tax = $shipping_cost_integer + ($shipping_cost_integer*0.23);

													$shipping_with_tax_formatted = number_format((float)$shipping_with_tax, 2, '.', '');  // Outputs -> 105.00

													echo '<span>'.$shipping_with_tax_formatted.' PLN</span>';

												echo '</div>';

												$i++;
											}
										}
									

								echo '</div>';

							echo '</div>';

						echo '</div>';


					endwhile; // End of the loop.
					?>

					</main><!-- #main -->
				</div><!-- #primary -->

			</div>

		</div>

	</div>

	
<?php
get_footer();