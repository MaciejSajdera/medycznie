<?php 
$term = get_field('product_showcase_category_1');

var_dump($term);

if( $term ): ?>

            <h2><?php echo esc_html( $term->name ); ?></h2>
            <p><?php echo esc_html( $term->description ); ?></p>

            <?php

                $products = wc_get_products(array(
                    'category' => array($term->slug),
                    'limit' => 3,
                    'order' => 'DESC',
                ));

                foreach( $products as $product ) {
                    var_dump($product->name);
                    var_dump($product->image_id);
                }

                /* Restore original Post Data 
                * NB: Because we are using new WP_Query we aren't stomping on the 
                * original $wp_query and it does not need to be reset.
                */
                wp_reset_postdata();

            ?>
            
<?php endif; ?>




<section class="categories-carousel">
<div class="swiper-container-categories">

    <!-- Add Pagination -->
    <div class="swiper-pagination swiper-pagination-categories"></div>
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide">
            <span id="shortcode_1_title" class="hide-element"><?= get_field('product_showcase_shortcode_1_title', $post->ID) ?></span>
            <div>
                <?= do_shortcode(get_field('product_showcase_shortcode_1', $post->ID)) ?>
                <div class="txt-centered">
                    <a href="<?php echo get_field("product_showcase_shortcode_1_link"); ?>" class="mobile-to-shop-button read-more">Pokaż więcej</a>
                </div>
            </div>
        </div>

        <div class="swiper-slide">
            <span id="shortcode_2_title" class="hide-element"><?= get_field('product_showcase_shortcode_2_title', $post->ID) ?></span>
            <div>
                <?= do_shortcode(get_field('product_showcase_shortcode_2', $post->ID)) ?>
                <div class="txt-centered">
                    <a href="<?php echo get_field("product_showcase_shortcode_2_link"); ?>" class="mobile-to-shop-button read-more">Pokaż więcej</a>
                </div>
            </div>
        </div> 

        <div class="swiper-slide">
            <span id="shortcode_3_title" class="hide-element"><?= get_field('product_showcase_shortcode_3_title', $post->ID) ?></span>
            <div>
                <?= do_shortcode(get_field('product_showcase_shortcode_3', $post->ID)) ?>
                <div class="txt-centered">
                    <a href="<?php echo get_field("product_showcase_shortcode_3_link"); ?>" class="mobile-to-shop-button read-more">Pokaż więcej</a>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- link below visible on mobile only -->
<!-- <a href="<?php echo get_permalink( get_option( 'woocommerce_shop_page_id' ) ); ?>" class="mobile-only mobile-to-shop-button read-more">Pokaż więcej</a> -->
</section>