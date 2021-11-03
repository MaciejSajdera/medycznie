<?php
    $search_icon = file_get_contents(get_stylesheet_directory_uri().'/dist/dist/svg/search-icon.svg');
    $user_icon = file_get_contents(get_stylesheet_directory_uri().'/dist/dist/svg/user_icon.svg');
    $user_icon_logged = file_get_contents(get_stylesheet_directory_uri().'/dist/dist/svg/user_icon_logged.svg');
    $cart_icon = file_get_contents(get_stylesheet_directory_uri().'/dist/dist/svg/cart_icon.svg');
?>  

<div class="header-top-wrapper header-top-wrapper-mobile">
    <div class="icons-wrapper">

        <!-- html below is a placeholder, <a> content renders from functions.php function -->
        <a class="cart-customlocation">
            <?php echo $cart_icon ?>
        </a>

        <div class="myaccount">
            <a class="myaccount-link myaccount-link-unlogged wrapper-flex-column" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>">

                    <?php echo $user_icon ?>

                <!-- <span class="sub-icon-text sub-login">Login / Rejestracja</span> -->
            </a>
        </div>

        <div class="search-icon-wrapper search-link">
            <div id="search-icon" class="wrapper-flex-column">
                <?php echo $search_icon ?>
            </div>
        </div>

    </div>

    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html( 'Primary Menu', 'pakistore' ); ?>
        <svg id="svgButton" class="ham hamRotate ham4" viewBox="0 0 100 100">
        <path
                class="line top"
                d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20" />
        <path
                class="line middle"
                d="m 70,50 h -40" />
        <path
                class="line bottom"
                d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20" />
        </svg>
    </button>

</div>