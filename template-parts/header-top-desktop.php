<?php
    $search_icon = file_get_contents(get_stylesheet_directory_uri().'/dist/dist/svg/search-icon.svg');
    $user_icon = file_get_contents(get_stylesheet_directory_uri().'/dist/dist/svg/user_icon.svg');
    $user_icon_logged = file_get_contents(get_stylesheet_directory_uri().'/dist/dist/svg/user_icon_logged.svg');
    $cart_icon = file_get_contents(get_stylesheet_directory_uri().'/dist/dist/svg/cart_icon.svg');
?>  

<div class="header-top-wrapper header-top-wrapper-desktop">

    <div class="site-branding">
        <?php
        the_custom_logo();
        ?>
    </div><!-- .site-branding -->

    <div class="search-panel">
        <?php echo do_shortcode('[fibosearch]'); ?>
    </div>

    <div class="icons-wrapper">

        <div id="search-icon">
                <?php echo $search_icon ?>
                <span class="sub-icon-text">Szukaj</span>
        </div>

        <?php
            if (is_user_logged_in()) {
                echo '
                <a href="'.get_permalink( wc_get_page_id( 'myaccount' ) ).'" class="myaccount myaccount-link-logged">
                    '.$user_icon_logged.'
                    <span class="sub-icon-text">Moje konto</span>
                 </a>
                 ';
            } else {
                echo '
                <a href="'.get_permalink( wc_get_page_id( 'myaccount' ) ).'" class="myaccount myaccount-link-unlogged">
                    '.$user_icon.'
                    <span class="sub-icon-text">Zaloguj się</span>
                 </a>
                 ';
            }
            ?>

        <!-- html below is a placeholder, <a> content renders from functions.php function -->
        <a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('Pokaż koszyk', 'woothemes'); ?>">

            <div class="cart-icon-wrapper">

                <?php echo $cart_icon ?>

                <span id="cart-counter"><?php echo sprintf($woocommerce->cart->cart_contents_count);?></span>

            </div>

            <span class="sub-icon-text">Koszyk</span>

        </a>

    </div>

</div>