<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package medycznie
 */
// Get all your existing shipping zones IDS
$zone_ids = array_keys( array('') + WC_Shipping_Zones::get_zones() );

$free_shipping_min_amount;

// Loop through shipping Zones IDs
foreach ( $zone_ids as $zone_id ) 
{
    // Get the shipping Zone object
    $shipping_zone = new WC_Shipping_Zone($zone_id);

    // Get all shipping method values for the shipping zone
    $shipping_methods = $shipping_zone->get_shipping_methods( true, 'values' );

    // Loop through each shipping methods set for the current shipping zone
    // FIRST METHOD SKIPPED (FREE SHIPPING)

    foreach ( array_slice($shipping_methods, 0, 1) as $instance_id => $shipping_method )  {
        
        $free_shipping_min_amount = $shipping_method->instance_settings['min_amount'];

            // var_dump($shipping_method);

    }
}

?>

<div class="advantages-container">

<a href="<?php echo get_permalink( get_option( 'woocommerce_shop_page_id' ) ); ?>" class="advantages__read-more">Bezpieczne zakupy</a>

<?php
$box_1 = get_field('adventages_info_1', get_option( 'page_on_front' ));
if( $box_1 ): ?>
    <div class="advantage-box">
        <img src="<?php echo esc_url( $box_1['box_image'] ); ?>" alt="<?php echo esc_attr( $box_1['image']['alt'] ); ?>" />
        <div class="content">
			<p><?php echo $box_1['box_header']; ?></p>

            <?php 

            $free_shipping_min_amount_tax_value = ($free_shipping_min_amount * 0.23) / 1.23;

            $free_shipping_min_amount_without_tax = $free_shipping_min_amount - $free_shipping_min_amount_tax_value;

            ?>

			<span><?php echo $box_1['box_description']; echo round($free_shipping_min_amount_without_tax, 2); ?> zł netto</span>
        </div>
    </div>
<?php endif; ?>
<?php
$box_2 = get_field('adventages_info_2', get_option( 'page_on_front' ));
if( $box_2 ): ?>
    <div class="advantage-box">
        <img src="<?php echo esc_url( $box_2['box_image'] ); ?>" alt="<?php echo esc_attr( $box_2['image']['alt'] ); ?>" />
        <div class="content">
			<p><?php echo $box_2['box_header']; ?></p>
			<span><?php echo $box_2['box_description']; ?></span>
        </div>
    </div>
<?php endif; ?>
<?php
$box_3 = get_field('adventages_info_3', get_option( 'page_on_front' ));
if( $box_3 ): ?>
    <div class="advantage-box">
        <img src="<?php echo esc_url( $box_3['box_image'] ); ?>" alt="<?php echo esc_attr( $box_3['image']['alt'] ); ?>" />
        <div class="content">
			<p><?php echo $box_3['box_header']; ?></p>
			<span><?php echo $box_3['box_description']; ?></span>
        </div>
    </div>
<?php endif; ?>
<?php
$box_4 = get_field('adventages_info_4', get_option( 'page_on_front' ));
if( $box_4 ): ?>
    <div class="advantage-box">
        <img src="<?php echo esc_url( $box_4['box_image'] ); ?>" alt="<?php echo esc_attr( $box_4['image']['alt'] ); ?>" />
        <div class="content">
			<p><?php echo $box_4['box_header']; ?></p>
			<span><?php echo $box_4['box_description']; ?></span>
        </div>
    </div>
<?php endif; ?>

</div>