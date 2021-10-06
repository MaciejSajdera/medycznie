<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package medycznie
 */



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

                    $min_value_for_free_shipping = get_free_shipping_minimum( 'Polska' );

            ?>

			<span><?php echo $box_1['box_description']; echo $min_value_for_free_shipping; ?> zł netto</span>
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