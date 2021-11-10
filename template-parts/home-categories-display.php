

<?php
$category_sliders = get_field("category_sliders");

foreach($category_sliders as $category) {

    if ($category): ?>

        <div class="category-carousel reveal-from__trigger">

            <div class="reveal-from__element reveal-from--bottom">

                <h2 class="title section-header"><?php echo esc_html($category->name); ?></h2>

                <div class="swiper-container-categories woocommerce">

                    <div class="swiper-button-prev swiper-button-prev-categories"></div>
                    <div class="swiper-button-next swiper-button-next-categories"></div>

                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper products products__in-carousel">

                    <?php
                    $args = [
                        "post_type" => "product",
                        "post_status" => "publish",
                        "posts_per_page" => 8,
                        "tax_query" => [
                            [
                                "taxonomy" => "product_cat",
                                "terms" => $category,
                                "field" => "slug",
                            ],
                        ],
                    ];

                    $loop = new WP_Query($args);
                    if ($loop->have_posts()) {
                        while ($loop->have_posts()):
                            $loop->the_post(); ?>
                                <!-- Slides -->
                                <div class="swiper-slide">

                                    <?php wc_get_template_part("content", "product"); ?>

                                </div>

                            <?php
                        endwhile;
                    } else {
                        echo __("No products found");
                    }

                    wp_reset_postdata();
                    ?>

                    </div>

                    <!-- Add Pagination -->
                    <div class="swiper-pagination swiper-pagination-categories"></div>
        
                </div>

            </div>

         </div>

<?php endif;

}

?>