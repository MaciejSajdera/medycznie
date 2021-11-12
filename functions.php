<?php
/**
 * medycznie functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package medycznie
 */

if ( ! function_exists( 'medycznie_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function medycznie_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on medycznie, use a find and replace
		 * to change 'medycznie' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'medycznie', get_template_directory() . '/assets/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'medycznie' ),
				'wooshop' => esc_html__( 'Shop', 'medycznie' ),
				'special-categories-menu' => esc_html__( 'Special Categories Menu', 'medycznie' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'medycznie_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'medycznie_setup' );

 
add_action( 'after_setup_theme', 'woo_addons_setup' );
function woo_addons_setup() {
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function medycznie_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'medycznie_content_width', 640 );
}
add_action( 'after_setup_theme', 'medycznie_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function medycznie_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'medycznie' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'medycznie' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'medycznie_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

function my_custom_js() {
    echo "
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PVQS2GD');</script>
	<!-- End Google Tag Manager -->

	<!-- Google Analytics -->
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-202645165-1', 'auto');
	ga('send', 'pageview');
	</script>
	<!-- End Google Analytics -->
	";
}
// Add hook for admin <head></head>
add_action( 'admin_head', 'my_custom_js', -1000 );
// Add hook for front-end <head></head>
add_action( 'wp_head', 'my_custom_js', -1000 );


function medycznie_scripts() {
	
	wp_enqueue_style( 'medycznie-style', get_template_directory_uri() . '/dist/css/style.css', array(), '11.27');

	wp_enqueue_script( 'medycznie-app', get_template_directory_uri() . '/dist/js/main.js', array(), '11.27', true );

	if (is_front_page()) {
		wp_enqueue_script( 'medycznie-carousel', get_template_directory_uri() . '/dist/js/carousel.js', array(), '11.27', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && is_product()) {
		wp_enqueue_script( 'single-product-add-to-cart', get_template_directory_uri() . '/dist/js/single-product-add-to-cart.js', array(), '11.06', true );
	}

	if ( is_cart() ) {
		wp_enqueue_script( 'cart-update-auto', get_template_directory_uri() . '/dist/js/cart-update-auto.js', array(), '', true );
	}

	if (
		is_blog() ) {
		wp_enqueue_script( 'blogAnimations', get_template_directory_uri() . '/dist/js/blogAnimations.js', array(), '', true );
	};

}
add_action( 'wp_enqueue_scripts', 'medycznie_scripts' );

add_theme_support( 'menus' );

function my_login_logo_one() { 
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
?> 
<style type="text/css"> 
body.login div#login h1 a {
	background-image: url(<?php echo $image[0]; ?>);
	width: 100%;
	height: 100%;
	background-size: contain;
	padding-bottom: 30px; 
} 
</style>
	<?php 
}
add_action( 'login_enqueue_scripts', 'my_login_logo_one' );


function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

// function add_async_defer($tag, $handle, $src) {
//     if('googlemaps' !== $handle) {//Here we check if our handle is googlemaps
//         return $tag; //We return the entire <script> tag as is without modifications.
//     }
//     return "<script type='text/javascript' async='async' defer='defer' src='".$src."'></script>";//Usually the value in $tag variable looks similar to this script tag but without the async and defer
// }
// add_filter('script_loader_tag', 'add_async_defer', 10, 3);


function wpb_add_google_fonts() {
	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap', false );
	// wp_enqueue_style( 'wpb-google-fonts2', 'https://fonts.googleapis.com/css2?family=Kodchasan:wght@300;400;700&display=swap', false ); 
}
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

function defer_parsing_of_js( $url ) {
    if ( is_user_logged_in() ) return $url; //don't break WP Admin
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
	if (strpos( $url, 'carousel' )) {
		return str_replace( ' src', ' defer src', $url );
	} else {
		return $url;
	}
}
add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );


/* Mobile Menu */

// Background Image for a menu item
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
	
	// loop
	foreach( $items as &$item ) {
		// $item->title .= '<span>'. $item->classes . '</span>';
		// vars
		$menu_thumbnail_image = get_field('menu_thumbnail_image', $item);
		
				// append bg image
		if( $menu_thumbnail_image ) {
					// $item->title .= '<span>'. $item->classes . '</span>';
			$item->title .= ' <span class="menu-thumbnail-image" style="background-image: url('. $menu_thumbnail_image .')"></span>';
		
		}
	}
	// return
	return $items;
}

// Attach custom class to all parent menu items

add_filter( 'wp_nav_menu_objects', 'wpdocs_add_menu_parent_class', 11, 3 );

function wpdocs_add_menu_parent_class( $items ) {
    $parents = array();

    // Collect menu items with parents.
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }

    // Add class.
    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'menu-parent-link'; //here attach the class
			// $item->title .= ' <span class="show-submenu"></span>';
        }
    }

    return $items;
}

// Attach show-submenu element to all parent menu items

function prefix_add_button_after_menu_item_children( $item_output, $item, $depth, $args ) {

        if ( in_array( 'menu-item-has-children', $item->classes ) || in_array( 'page_item_has_children', $item->classes ) ) {
            $item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><span class="show-submenu" aria-expanded="false" aria-pressed="false"></span>', $item_output );
        }

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_add_button_after_menu_item_children', 10, 4 );


class Has_Child_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element ) {
            return;
        }
        $element->has_children = ! empty( $children_elements[ $element->{$this->db_fields['id']} ] );
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}

/* Blog */

function new_excerpt_more($more) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more', 21 );

function the_excerpt_more_link( $excerpt ){
    $post = get_post();
    $excerpt .= '<a class="read-more" href="'. get_permalink($post->ID) . '">Czytaj dalej</a>';
    return $excerpt;
}
add_filter( 'the_excerpt', 'the_excerpt_more_link', 21 );

add_theme_support('category-thumbnails');

add_theme_support( 'post-thumbnails' ); 

/*
 *WOOCOMMERCE 
*/

/*Declare WooCommerce support */
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


add_action( 'init', function(){
	add_post_type_support( 'product', 'page-attributes' );
});


function disable_woo_commerce_sidebar() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); 
}
add_action('init', 'disable_woo_commerce_sidebar');

//Change loop_product_title from h2 to p tag

remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'change_loop_products_title', 10 );
function change_loop_products_title() {
    echo '<p class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</p>';
}

//hide shipping from cart template

add_filter( 'woocommerce_cart_needs_shipping', 'filter_cart_needs_shipping' );
function filter_cart_needs_shipping( $needs_shipping ) {
    if ( is_cart() ) {
        $needs_shipping = false;
    }
    return $needs_shipping;
}


add_filter( 'woocommerce_min_password_strength', 'reduce_min_strength_password_requirement' );
function reduce_min_strength_password_requirement( $strength ) {
    // 3 => Strong (default) | 2 => Medium | 1 => Weak | 0 => Very Weak (anything).
    return 1; 
}

function custom_override_default_address_fields( $address_fields ) {
	$address_fields['address_1']['label'] = 'Ulica';
	$address_fields['address_1']['placeholder'] = '';
	$address_fields['address_2']['label'] = 'Numer domu/mieszkania';
	$address_fields['address_2']['placeholder'] = '';
	$address_fields['address_2']['required'] = true; // Making Address 2 field required
	
	return $address_fields;
}
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );


/* Pole Numer domu/mieszkania - billing*/

function display_billing_address_2_field($billing_fields){

	$billing_fields['billing_address_2'] = array(
		'type' => 'text',
		'label' =>  __('Numer domu/mieszkania',  'woocommerce' ),
		'class' => array('validate-required'),
		'required' => true,
	);

   return $billing_fields;
}
add_filter('woocommerce_billing_fields' , 'display_billing_address_2_field');


/* Pole Numer domu/mieszkania -shipping */

function display_shipping_address_2_field($billing_fields){

	$billing_fields['shipping_address_2'] = array(
		'type' => 'text',
		'label' =>  __('Numer domu/mieszkania',  'woocommerce' ),
		'class' => array('validate-required'),
		'required' => true,
	);

   return $billing_fields;
}
add_filter('woocommerce_shipping_fields' , 'display_shipping_address_2_field');


/* Pole na NIP */

   function display_billing_vat_fields($billing_fields){

	   $billing_fields['billing_nip'] = array(
		   'type' => 'text',
		   'label' =>  __('NIP',  'woocommerce' ),
		//    'placeholder'   => __( 'Uzupełnij aby otrzymać fakturę VAT' ),
		   'class' => array('form-row-wide'),
		   'required' => false,
		   'clear' => true,
		   'priority' => 35, // To change the field location increase or decrease this value
	   );

	   return $billing_fields;
   }
   add_filter('woocommerce_billing_fields' , 'display_billing_vat_fields');


/**
* Save VAT Number in the order meta
*/
function wpdesk_checkout_vat_number_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['billing_nip'] ) ) {
        update_post_meta( $order_id, '_billing_nip', sanitize_text_field( $_POST['billing_nip'] ) );
    }
}
add_action( 'woocommerce_checkout_update_order_meta', 'wpdesk_checkout_vat_number_update_order_meta' );


/**
 * Wyświetlenie pola NIP
 */
function wpdesk_vat_number_display_admin_order_meta( $order ) {
    echo '<p><strong>' . __( 'NIP', 'woocommerce' ) . ':</strong> ' . get_post_meta( $order->id, '_billing_nip', true ) . '</p>';
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'wpdesk_vat_number_display_admin_order_meta', 10, 1 );


/**
* Pole NIP w mailu
*/
// function wpdesk_vat_number_display_email( $keys ) {
//      $keys['NIP'] = '_billing_nip';
//      return $keys;
// }
// add_filter( 'woocommerce_email_order_meta_keys', 'wpdesk_vat_number_display_email' );

// function display_email_order_user_meta( $order, $sent_to_admin, $plain_text ) {
//     echo 'NIP: ' . get_post_meta( $order->id, '_billing_nip', true ) . '';
// }
// add_action('woocommerce_email_customer_details', 'display_email_order_user_meta', 30, 3 );

/* Pole "Chcę Fakturę" */

function display_billing_faktura_firma($billing_fields){

	$billing_fields['billing_faktura_firma'] = array(
		'type' => 'checkbox',
		'label' =>  __('Chcę otrzymać fakturę VAT',  'woocommerce' ),
		'class' => array('woocommerce-form__label-for-checkbox'),
		'required' => false,
		'clear' => true,
		'priority' => 40, // To change the field location increase or decrease this value
	);

	return $billing_fields;
}
add_filter('woocommerce_billing_fields' , 'display_billing_faktura_firma');

/**
* Zapisz wartość flagi "Chcę fakturę" w order meta
*/
function wpdesk_checkout_billing_faktura_firma_order_meta( $order_id ) {
    if ( ! empty( $_POST['billing_faktura_firma'] ) ) {
        update_post_meta( $order_id, '_billing_faktura_firma', sanitize_text_field( $_POST['billing_faktura_firma'] ) );
    }
}
add_action( 'woocommerce_checkout_update_order_meta', 'wpdesk_checkout_billing_faktura_firma_order_meta' );

/**
 * Wyświetlenie wartość flagi "Chcę fakturę" w panelu admina
 */
function wpdesk_billing_faktura_firma_admin_order_meta( $order ) {

	$want_invoice_text;

	if (get_post_meta( $order->id, '_billing_faktura_firma', true ) == 1) {
		$want_invoice_text = "Tak";
	} else {
		$want_invoice_text = "Nie";
	}

    echo '<p><strong>' . __( 'Chcę fakturę', 'woocommerce' ) . ':</strong> ' . $want_invoice_text . '</p>';
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'wpdesk_billing_faktura_firma_admin_order_meta', 10, 1 );

/**
 * Notify admin when a new customer account is created
 */
function woocommerce_created_customer_admin_notification( $customer_id ) {
  wp_send_new_user_notifications( $customer_id, 'admin' );
}
add_action( 'woocommerce_created_customer', 'woocommerce_created_customer_admin_notification' );

function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
	
	$user_count = count_users();

	$wp_new_user_notification_email['headers'] = "From: Sklep <zamowienia@medycznie.com.pl> \n\r cc: Robert Bielamowicz <robert@medycznie.com.pl>";
    $wp_new_user_notification_email['subject'] = sprintf( '[%s] Nowy użytkownik %s .', $blogname, $user_role, $user->user_login );
    $wp_new_user_notification_email['message'] = sprintf( "%s ( %s ) zarejestrował się w Twoim sklepie %s.", $user->user_login, $user->user_email, $blogname ) .
	"\n" . sprintf("Gratulacje, to twój %d zarejestrowany użytkownik!", $user_count['total_users']);
    return $wp_new_user_notification_email;
}
add_filter( 'wp_new_user_notification_email_admin', 'custom_wp_new_user_notification_email', 10, 3 );

/**
 * Show number of items in a cart and their value
 */

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );



function woocommerce_header_add_to_cart_fragment( $fragments ) {

	global $woocommerce;

	ob_start();

	$cart_icon = file_get_contents(get_stylesheet_directory_uri().'/dist/dist/svg/cart_icon.svg');

	?>

	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('Pokaż koszyk', 'woothemes'); ?>">

			<div class="cart-icon-wrapper">

				<?php 
				echo $cart_icon;
				?>

				<span id="cart-counter"><?php echo sprintf($woocommerce->cart->cart_contents_count);?></span>

			</div>

			<span class="sub-icon-text">Koszyk</span>

	</a>

	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}

// Remove trash icon at cart page and then add a new one.
function kia_cart_item_remove_link( $link, $cart_item_key ) {
    return str_replace( '×', '<span class="cart-remove-icon"></span>', $link );
}
add_filter( 'woocommerce_cart_item_remove_link', 'kia_cart_item_remove_link', 10, 2 );


function add_percentage_to_sale_badge( $html, $post, $product ) {

  if( $product->is_type('variable')){
      $percentages = array();

      // Get all variation prices
      $prices = $product->get_variation_prices();

      // Loop through variation prices
      foreach( $prices['price'] as $key => $price ){
          // Only on sale variations
          if( $prices['regular_price'][$key] !== $price ){
              // Calculate and set in the array the percentage for each variation on sale
              $percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
          }
      }
      // We keep the highest value
      $percentage = max($percentages) . '%';

  } elseif( $product->is_type('grouped') ){
      $percentages = array();

      // Get all variation prices
      $children_ids = $product->get_children();

      // Loop through variation prices
      foreach( $children_ids as $child_id ){
          $child_product = wc_get_product($child_id);

          $regular_price = (float) $child_product->get_regular_price();
          $sale_price    = (float) $child_product->get_sale_price();

          if ( $sale_price != 0 || ! empty($sale_price) ) {
              // Calculate and set in the array the percentage for each child on sale
              $percentages[] = ( floatval( $prices['regular_price'][ $key ] ) - floatval( $price ) ) / floatval( $prices['regular_price'][ $key ] ) * 100;
          }
      }
      // We keep the highest value
      $percentage = max($percentages) . '%';

  } else {
      $regular_price = (float) $product->get_regular_price();
      $sale_price    = (float) $product->get_sale_price();

      if ( $sale_price != 0 || ! empty($sale_price) ) {
          $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';

      }  else {
          return $html;
      }
  }
  return '<span class="sales-badge">' . esc_html__( '-', 'woocommerce' ) . ' ' . $percentage . '</span>';
}

add_filter( 'woocommerce_sale_flash', 'add_percentage_to_sale_badge', 20, 3 );


// Alter WooCommerce View Cart Text
add_filter( 'gettext', function( $translated_text ) {
    if ( 'View cart' === $translated_text ) {
        $translated_text = 'Pokaż koszyk';
    }
    return $translated_text;
} );

//badge 'new' for recent products

function bbloomer_new_badge_shop_page() {
   global $product;
   $newness_days = 14;
   $created = strtotime( $product->get_date_created() );
   $is_newly_added = ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created;

   if ( has_term( 68, 'product_cat' ) ) {
      echo '<span class="itsnew">' . esc_html__( 'Nowość!', 'woocommerce' ) . '</span>';
   }

}
add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_new_badge_shop_page', 3 );

//badge 'promo' for recent products

function bbloomer_promo_badge_shop_page() {
	global $product;

	if ( has_term( 70, 'product_cat' ) && !$product->is_on_sale() ) {
	   echo '<span class="sales-badge">' . esc_html__( 'Promocja!', 'woocommerce' ) . '</span>';
	}
 
 }
 add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_promo_badge_shop_page', 3 );

//badge 'bestseller'

function bbloomer_best_badge_shop_page() {
   global $product;
   if ( has_term( 23, 'product_cat' ) ) {
	  echo '<div class="bestseller-wrapper">';
	  echo '<span class="bestseller"></span>';
	  echo '<span>' . esc_html__( 'bestseller', 'woocommerce' ) . '</span>';
	  echo '</div>';
   }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_best_badge_shop_page', 3 );

//SINGLE PRODUCT LAYOUT

//Title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'my_woocommerce_before_single_product', 'woocommerce_template_single_title', 5 );

//Sale Badge
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', 5 );

//Rating
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 7 );

//Availbility

add_action( 'woocommerce_single_product_summary', 'my_woocommerce_availbility', 7 );

function my_woocommerce_availbility() {

	global $product;

	$availbility_status;

	if( $product->is_in_stock() ) {
		$availbility_status = '<span class="product-available">Na stanie</span>';		
	}
	
	// elseif( $product->is_in_stock() && $product->get_stock_quantity() < 10 ) {
	// 	$availbility_status = '<span class="product-low-stock">'. $product->get_stock_quantity() .'szt.</span>';		
	// }
	
	// elseif( $product->is_in_stock() && $product->get_stock_quantity() ) {
	// 	$availbility_status = '<span class="product-available">'. $product->get_stock_quantity() .'szt.</span>';	
	// }
	
	if( !$product->is_in_stock() ) {
		$availbility_status = '<span class="product-notavailable">Brak</span>';
	}
	
	echo '<div class="product-info"><div class="product-info__label">Dostępność:</div><div class="product-info__value">'.$availbility_status.'</div></div>';
}



//Meta information
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 60 );

add_action( 'woocommerce_single_product_summary', 'show_producent_info', 65 );
function show_producent_info() {
	$terms = get_the_terms( $post->ID, 'manufacturer' );

	if(is_wp_error( $terms )){
		return;
	}

	elseif($terms) {

		foreach ( $terms as $term ){
			$producent_name = $term->name;
			$imageURL = get_field("producent_logo", $term);
			$producent_link = get_term_link( $term );

			if ($imageURL) :
			echo '<div class="product-info product-info--producent"><div class="product-info__label">Producent:</div><a class="product-info__value" href="'.$producent_link.'"><img src="'.$imageURL.'" alt="'.$producent_name.'"></a></div>';
			else :
			echo '<div class="product-info product-info--producent"><div class="product-info__label">Producent:</div><a class="product-info__value" href="'.$producent_link.'">' .$producent_name.'</a></div>';
			endif;
		}
	}
}



//Excerpt
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
// add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_excerpt', 5 );

// remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

//Related products && Upsell products

// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// add_action('woocommerce_after_single_product', 'woocommerce_upsell_display', 15 );
// add_action('woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );

/**
 * Change number of related products output
 */ 
function woo_related_products_limit() {
	global $product;
	  
	  $args['posts_per_page'] = 6;
	  return $args;
  }
  add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
	function jk_related_products_args( $args ) {
	  $args['posts_per_page'] = 6; // 4 related products
	  $args['columns'] = 3; // arranged in 2 columns
	  return $args;
  }

// Change WooCommerce "Related products" text

add_filter('gettext', 'change_rp_text', 10, 3);
add_filter('ngettext', 'change_rp_text', 10, 3);

function change_rp_text($translated, $text, $domain)
{
     if ($text === 'Related products' && $domain === 'woocommerce') {
         $translated = esc_html__('Powiązane produkty', $domain);
     }
     return $translated;
}


//Price
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

function my_woocommerce_template_single_price() {
	global $product;

	if ( is_singular() && is_product() && is_single( $product->get_id() )) {

		echo '<div class="product-info product-info--price">';
		echo '<div class="product-info__label"><span class="price-text">Cena: <span></div>';
		echo '<div class="price">'.$product->get_price_html().'</div>';
		echo '</div>';

	}
}
add_action( 'woocommerce_single_product_summary', 'my_woocommerce_template_single_price', 8 );

add_action( 'woocommerce_single_product_summary', 'show_price_without_tax', 8);

function show_price_without_tax() {
	global $product;

	echo '<div id="price-without-tax">netto: '. woocommerce_price( $product->get_price_excluding_tax() ) .'</div>';
}

// define the woocommerce_get_price_html callback 
// function filter_woocommerce_get_price_html( $price, $product ) { 
//     // make filter magic happen here... 

// 	if ( is_singular() && is_product() && is_single( $product->get_id() )) {

// 		$price .= '<span class="price-text">Cena: <span>';
// 	}

//     return $price;
// }; 
         
// // add the filter 
// add_filter( 'woocommerce_get_price_html', 'filter_woocommerce_get_price_html', 10, 2 ); 



function my_display_quantity_minus() {
	global $product;

	// if( $product->is_type( 'simple' ) ){
		echo '<button type="button" class="minus"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 13H5v-2h14v2z"/></svg></button>';
	// }

}
add_action( 'woocommerce_before_add_to_cart_quantity', 'my_display_quantity_minus' );

function my_display_quantity_plus() {
	global $product;

	// if( $product->is_type( 'simple' ) ){
		echo '<button type="button" class="plus"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg></button>';
	// }

}
add_action( 'woocommerce_after_add_to_cart_quantity', 'my_display_quantity_plus' );


add_filter( 'woocommerce_quantity_input_args', 'custom_quantity_input_args', 20, 2 );
function custom_quantity_input_args( $args, $product ) {
    if( $product->get_stock_quantity() == 1 && is_product() ){
        $args['max_value'] = '1';
		
    }
    return $args;
}



// function woocommerce_template_product_description() {
// 	wc_get_template( 'single-product/tabs/description.php' );
// 	}

// add_action( 'my_single_product_description', 'woocommerce_template_product_description', 20 );


/* Disable additional informations table at single product view */

function customize_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); 
	// unset( $tabs['description'] ); 
	
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'customize_product_tabs', 9999 );

/* Disable short description at single product view */

// function remove_short_description() {
 
// 	remove_meta_box( 'postexcerpt', 'product', 'normal');
	 
// }
// add_action('add_meta_boxes', 'remove_short_description', 999);


add_action('woocommerce_init', 'shipping_instance_form_fields_filters');

function shipping_instance_form_fields_filters()
{
    $shipping_methods = WC()->shipping->get_shipping_methods();
    foreach($shipping_methods as $shipping_method) {
        add_filter('woocommerce_shipping_instance_form_fields_' . $shipping_method->id, 'shipping_instance_form_add_extra_fields');
    }
}

function shipping_instance_form_add_extra_fields($settings)
{
    $settings['shipping_method_image'] = [
        'title' => 'link-to-image',
        'type' => 'text', 
        'placeholder' => 'for example https://medycznie.com.pl/wp-content/uploads/2021/06/DPD_logo.png',
        'description' => ''
    ];

    return $settings;
} 


//Remove unwanted colon from labels
add_filter( 'woocommerce_cart_shipping_method_full_label', 'change_cart_shipping_method_full_label', 10, 2 );
function change_cart_shipping_method_full_label( $label, $method ) {
    $label = $method->get_label(); 
 
    if ( $method->cost > 0 ) { 
        if ( WC()->cart->tax_display_cart == 'excl' ) { 
            $label .= ' ' . wc_price( $method->cost ); 
            if ( $method->get_shipping_tax() > 0 && WC()->cart->prices_include_tax ) { 
                $label .= ' <small class="tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>'; 
            } 
        } else { 
            $label .= ' ' . wc_price( $method->cost + $method->get_shipping_tax() ); 
            if ( $method->get_shipping_tax() > 0 && ! WC()->cart->prices_include_tax ) { 
                $label .= ' <small class="tax_label">' . WC()->countries->inc_tax_or_vat() . '</small>'; 
            } 
        } 
    } 
 
    return $label; 
}

function filter_woocommerce_cart_shipping_method_full_label( $label, $method ) {      
   // Targeting shipping method "Flat rate instance Id 2"
   $delivery_option_free = get_field('delivery_option_1', get_option( 'woocommerce_cart_page_id' ) );
   $delivery_option_2 = get_field('delivery_option_2', get_option( 'woocommerce_cart_page_id' ) );
   $delivery_option_3 = get_field('delivery_option_3', get_option( 'woocommerce_cart_page_id' ) );
   $delivery_option_4 = get_field('delivery_option_4', get_option( 'woocommerce_cart_page_id' ) );
   $delivery_option_5 = get_field('delivery_option_5', get_option( 'woocommerce_cart_page_id' ) );
   $delivery_option_6 = get_field('delivery_option_6', get_option( 'woocommerce_cart_page_id' ) );

   	if( $method->id === "free_shipping:3" ) {
       $label .= '<img id="free-shipping-check" src="'.$delivery_option_free.'" />';
   	}

	if( $method->id === "free_shipping:12" ) {
		$label .= '<img id="free-shipping-check" src="'.$delivery_option_free.'" />';
	}
	
   	if( $method->id === "flat_rate:7" ) {
		$label .= '<img src="'.$delivery_option_2.'" />';
	}

	if( $method->id === "flat_rate:8" ) {
		$label .= '<img src="'.$delivery_option_3.'" />';
	}

	if( $method->id === "flat_rate:10" ) {
		$label .= '<img src="'.$delivery_option_5.'" />';
	}

	if( $method->id === "flat_rate:11" ) {
		$label .= '<img src="'.$delivery_option_6.'" />';
	}

	if( $method->id === "flexible_shipping_single:12" ) {
		$label .= '<img src="'.$delivery_option_4.'" />';
	}

   return $label; 
}

add_filter( 'woocommerce_cart_shipping_method_full_label', 'filter_woocommerce_cart_shipping_method_full_label', 10, 2 ); 



 /**
 * Filter payment gateways
 */
function my_custom_available_payment_gateways( $gateways ) {


	if (is_checkout()) {

		$chosen_shipping_rates = ( isset( WC()->session ) ) ? WC()->session->get( 'chosen_shipping_methods' ) : array();

			if ( in_array( 'flat_rate:7', $chosen_shipping_rates ) ) :
			unset( $gateways['cod'] );
			
			elseif ( in_array( 'flat_rate:8', $chosen_shipping_rates ) ) :
			unset( $gateways['bacs'] );
			unset( $gateways['przelewy24'] );
			
			elseif ( in_array( 'flat_rate:9', $chosen_shipping_rates ) ) :
			unset( $gateways['cod'] );
			
			elseif ( in_array( 'flat_rate:10', $chosen_shipping_rates ) ) :
			unset( $gateways['cod'] );

			elseif ( in_array( 'flat_rate:11', $chosen_shipping_rates ) ) :
				unset( $gateways['bacs'] );
				unset( $gateways['przelewy24'] );

			elseif ( in_array( 'free_shipping:3', $chosen_shipping_rates ) ) :
				unset( $gateways['cod'] );

			elseif ( in_array( 'free_shipping:12', $chosen_shipping_rates ) ) :
				unset( $gateways['bacs'] );
				unset( $gateways['przelewy24'] );

		endif;
		return $gateways;

	} else {
		return;
	}
}

add_filter( 'woocommerce_available_payment_gateways', 'my_custom_available_payment_gateways' );


function get_free_shipping_minimum($zone_name = 'Poland') {
	if ( ! isset( $zone_name ) ) return null;
  
	$result = null;
	$zone = null;
  
	$zones = WC_Shipping_Zones::get_zones();
	foreach ( $zones as $z ) {
	  if ( $z['zone_name'] == $zone_name ) {
		$zone = $z;
	  }
	}
  
	if ( $zone ) {
	  $shipping_methods_nl = $zone['shipping_methods'];
	  $free_shipping_method = null;
	  foreach ( $shipping_methods_nl as $method ) {
		if ( $method->id == 'free_shipping' ) {
		  $free_shipping_method = $method;
		  break;
		}
	  }
  
	  if ( $free_shipping_method ) {
		$result = $free_shipping_method->min_amount;
	  }
	}
  
	return $result;
}
  
function bbloomer_free_shipping_cart_notice() {

	$free_shipping_min = get_free_shipping_minimum( 'Polska' );

   $current = WC()->cart->get_cart_contents_total();

   $missing_amount = $free_shipping_min - $current;

   $missing_amount_formatted = number_format((float)$missing_amount, 2, '.', '');
  
   if ( $free_shipping_min && $current < $free_shipping_min ) {
      $added_text = 'Do darmowej dostawy brakuje Ci ' . '<strong>' . $missing_amount_formatted . ' zł netto </strong>';
      $return_to = wc_get_page_permalink( 'shop' );
      $notice = sprintf( '<a href="%s" class="button wc-forward add_to_cart_button">%s</a> %s', esc_url( $return_to ), 'Kontynuuj zakupy', $added_text );
      wc_print_notice( $notice, 'notice' );
   }
}

add_action( 'woocommerce_before_cart_contents', 'bbloomer_free_shipping_cart_notice' );

// function my_hide_shipping_when_free_is_available( $rates ) {
// 	$free = array();
// 	foreach ( $rates as $rate_id => $rate ) {
// 		if ( 'free_shipping' === $rate->method_id ) {
// 			$free[ $rate_id ] = $rate;
// 		}
// 	}
// 	return ! empty( $free ) ? $free : $rates;
// }
// add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );


//Change all shipping costs to 0 when minimum amount is reached

add_filter( 'woocommerce_package_rates', 'wc_apply_free_shipping_to_all_methods', 10, 2 );
function wc_apply_free_shipping_to_all_methods( $rates, $package ) {


	$min_value_for_free_shipping = get_free_shipping_minimum( 'Polska' );
	$cart_contents_pretax_value = WC()->cart->get_cart_contents_total();

  if( isset( $rates['free_shipping:3'] ) && ($cart_contents_pretax_value >= $min_value_for_free_shipping) ) { 
    unset( $rates['free_shipping:3'] );

    foreach( $rates as $rate_key => $rate ) { 
                // Append rate label titles (free)
                $rates[$rate_key]->label .= ' ' . __('(Darmowa wysyłka)', 'woocommerce');

                // Set rate cost
                $rates[$rate_key]->cost = 0;

                // Set taxes rate cost (if enabled)
                $taxes = array();
                foreach ($rates[$rate_key]->taxes as $key => $tax){
					
                    if( $rates[$rate_key]->taxes[$key] > 0 )
                        $taxes[$key] = 0;
                }
                $rates[$rate_key]->taxes = $taxes;
    }   
  }
  return $rates;
}


add_action('init', function(){
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
});

if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    } 
}

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {   
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog' ) {
        global $post, $woocommerce;
		$output = '';
		
		$body_classes = get_body_class();
			if(in_array('woocommerce-cart', $body_classes))
			{
				$on_cart_page = true;
			} else {
				//Other Page
				$on_cart_page = false;
			}

        if ( has_post_thumbnail() && $on_cart_page === false ) {
			
			$src = str_replace( ' ', '%20', get_the_post_thumbnail_url( $post->ID, $size ) );
			
            $output .= '<img class="lazy my-lazy-img" src="'. content_url().'/uploads/woocommerce-placeholder-300x300.png" data-src="' . $src . '" data-srcset="' . $src . '" alt="'.get_the_title().'" loading="lazy">';
		} elseif ($on_cart_page === true ) {
			$src = str_replace( ' ', '%20', get_the_post_thumbnail_url( $post->ID, $size ) );


            $output .= '<img class="cross-sell-img" src="'.  $src . '" alt="'.get_the_title().'">';
		} else {
             $output .= wc_placeholder_img( $size );
        }

        return $output;
    }
}


// Remove the product rating display on product loops
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


add_filter( 'the_title', 'shorten_woo_product_title', 10, 2 );
function shorten_woo_product_title( $title, $id ) {
	global $woocommerce_loop;
    if (! is_singular( array( 'product' ) ) && get_post_type( $id ) === 'product' || is_product() && $woocommerce_loop['name'] == 'related' || is_product() && $woocommerce_loop['name'] == 'up-sells' ) {
        return mb_strimwidth( $title, 0, 61, '...' ); // change last number to the number of words you want
    } else {
        return $title;
    }
}

// ---------------------------------------------
// Remove Cross Sells From Default Position 
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
 
// ---------------------------------------------
// Add them back UNDER the Cart Table
 
add_action( 'woocommerce_after_cart_totals', 'woocommerce_cross_sell_display' );


add_filter( 'woocommerce_cross_sells_columns', 'bbloomer_change_cross_sells_columns' );
 
function bbloomer_change_cross_sells_columns( $columns ) {
return 4;
}

add_filter( 'woocommerce_dpd_disable_ssl_verification', '__return_true' ); 
add_filter( 'woocommerce_dpd_disable_cache_wsdl', '__return_true' );

function custom_cart_totals_order_total_html( $value ){
    $value = '<div class="total-with-tax"><strong>' . WC()->cart->get_total() . '</strong> ';

// If prices are tax inclusive, show taxes here.
	if ( wc_tax_enabled() && WC()->cart->display_prices_including_tax() ) {
		$tax_string_array = array();
		$cart_tax_totals  = WC()->cart->get_tax_totals();
		if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) {
			foreach ( $cart_tax_totals as $code => $tax ) {
				$tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
			}
		} elseif ( ! empty( $cart_tax_totals ) ) {
			$tax_string_array[] = sprintf( '%s %s', wc_price( WC()->cart->get_taxes_total( true, true ) ), WC()->countries->tax_or_vat() );
		}

        if ( ! empty( $tax_string_array ) ) {
            $taxable_address = WC()->customer->get_taxable_address();
            $estimated_text  = '';
			$value .= '<small class="includes_tax">('
			/* translators: includes tax information */
			. esc_html__( 'zawiera', 'woocommerce' )
			. ' '
			. wp_kses_post( implode( ', ', $tax_string_array ) )
			. esc_html( $estimated_text )
			. ')</small></div>';
        }
    }
    return $value;
}

add_filter( 'woocommerce_cart_totals_order_total_html', 'custom_cart_totals_order_total_html', 20, 1 );


//force number of products per row

add_filter('loop_shop_columns',function(){return 3;});

function footer_copyright() {
	global $wpdb;
	$copyright_dates = $wpdb->get_results("
	SELECT
	YEAR(min(post_date_gmt)) AS firstdate,
	YEAR(max(post_date_gmt)) AS lastdate
	FROM
	$wpdb->posts
	WHERE
	post_status = 'publish'
	");
	$output = '';
	if($copyright_dates) {
	$copyright = "&copy; " . $copyright_dates[0]->firstdate;
	if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
	$copyright .= '-' . $copyright_dates[0]->lastdate;
	}
	$output = $copyright;
	}
	return $output;
}

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
return array(
        'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
		'delimiter'   => '<span class="woocommerce-breadcrumb__separator">/</span>',
        'wrap_after'  => '</nav>',
        'before'      => ' ',
        'after'       => ' ',
    );
}

/*
Based on:
Plugin Name: VG Woo Sort
Description: Aditional sort, products per page dropdown for WooCommerce Shop
Version: 2.0
Author: Vijayan G
Author URI: www.vijayan.in
*/

/**
 * Adds Custom Sorting
 * 
 * This plugin is used to add and modify sorting options in product archive page
 */
class My_VG_Sort
{

    /**
     * Callback method to implement A-Z & Z-A sort functionality
     * 
     * @since 1.0
     */
	
    public static function custom_woocommerce_get_catalog_ordering_args($args)
    {
        $orderby_value = isset($_GET['orderby']) ?
            wc_clean($_GET['orderby']) :
            apply_filters(
                'woocommerce_default_catalog_orderby',
                get_option('woocommerce_default_catalog_orderby')
            );

        if ('reverse_list' == $orderby_value) {
            $args['orderby'] = 'title';
            $args['order'] = 'desc';
        } else if ('alpha_list' == $orderby_value) {
            $args['orderby'] = 'title';
            $args['order'] = 'asc';
        }

        return $args;
    }

    /**
     * Callback method to alter number of products per page
     * 
     * @since 2.0
     */
    public static function custom_products_per_page($per_page)
    {

        $count = (int) get_query_var('show', 16);

        switch ($count) {
            case 48:
            case 72:
            case -1:
                $per_page = $count;
                break;
            default:
                $per_page = 24;
                break;
        }

        return $per_page;
    }

    /**
     * Template method responsible for total products per page
     * 
     * @since 2.0
     */
    public static function template_products_per_page()
    {
        wc_get_template('products-per-page.php', array(), '', plugin_dir_path(__FILE__) . 'template-parts/');
    }

    /**
     * Add the query variables used by products per page logic
     * 
     * @since 2.0
     */
    public static function add_query_vars_products_per_page($vars)
    {
        $vars[] = 'show';

        return $vars;
    }
}

add_filter('loop_shop_per_page', array('My_VG_Sort', 'custom_products_per_page'));
add_action('woocommerce_before_shop_loop', array('My_VG_Sort', 'template_products_per_page'), 30);
add_filter('query_vars', array('My_VG_Sort', 'add_query_vars_products_per_page'));


/* SEO */

/* Remove all rel="nofollow" from all add to cart buttons */

add_filter( 'woocommerce_loop_add_to_cart_args', 'remove_rel', 10, 2 );

function remove_rel( $args, $product ) {
    unset( $args['attributes']['rel'] );

    return $args;
}

function pagely_security_headers( $headers ) {
    $headers['X-XSS-Protection'] = '1; mode=block';
    $headers['X-Content-Type-Options'] = 'nosniff';
    $headers['X-Content-Security-Policy'] = 'default-src \'self\'; script-src \'self\';';

    return $headers;
}

add_filter( 'wp_headers', 'pagely_security_headers' );

add_action( 'send_headers', 'send_frame_options_header', 10, 0 );

/* Hide specific options for specific admin user */

// function hide_menu() {
  
// 		// Uncomment the part below if you need it to specific user. Change username "demouser"
// 		$user_id = get_current_user_id();
	
// 		// Use this for specific user role. Change site_admin part accordingly
// 		if (is_admin() && $user_id == '13') { 
		
// 			/* DASHBOARD */
// 				// remove_menu_page( 'index.php' ); // Dashboard + submenus
// 				// remove_menu_page( 'about.php' ); // WordPress menu
// 				remove_submenu_page( 'index.php', 'update-core.php');  // Update
				
// 				/* WP DEFAULT MENUS */
// 				// remove_menu_page( 'edit-comments.php' ); //Comments
// 				remove_menu_page( 'plugins.php' ); //Plugins
// 				remove_menu_page( 'tools.php' ); //Tools
// 				remove_menu_page( 'users.php' ); //Users
// 				// remove_menu_page( 'edit.php' ); //Posts
// 				// remove_menu_page( 'upload.php' ); //Media
// 				// remove_menu_page( 'edit.php?post_type=page' ); //Pages
// 				// remove_menu_page( 'themes.php' ); //Appearance
// 				remove_menu_page( 'options-general.php' ); //Settings

// 				remove_submenu_page( 'themes.php', 'customize.php?return=%2Fwp-admin%2F&autofocus%5Bcontrol%5D=header_image' );
// 				remove_submenu_page( 'themes.php', 'customize.php?return=%2Fwp-admin%2F&autofocus%5Bcontrol%5D=background_image' );
		
// 				/* SETTINGS PAGE SUBMENUS */
// 				//remove_submenu_page( 'options-general.php', 'options-permalink.php');  // Permalinks
// 				remove_submenu_page( 'options-general.php', 'options-writing.php');  // Writing
// 				remove_submenu_page( 'options-general.php', 'options-reading.php');  // Reading
// 				remove_submenu_page( 'options-general.php', 'options-discussion.php');  // Discussion
// 				remove_submenu_page( 'options-general.php', 'options-media.php');  // Media
// 				//remove_submenu_page( 'options-general.php', 'options-general.php');  // General
// 				remove_submenu_page( 'options-general.php', 'options-privacy.php');  // Privacy
		
// 				/* APPEARANCE SUBMENUS */
// 				remove_submenu_page( 'themes.php', 'widgets.php' ); // hide Widgets
// 				// remove_submenu_page( 'themes.php', 'nav-menus.php' ); // hide Menus
// 				remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
// 				remove_submenu_page('themes.php', 'theme-editor.php'); // hide Theme editor
		
// 				/* HIDE CUSTOMIZER MENU */
// 				$customizer_url = add_query_arg( 'return', urlencode( remove_query_arg( wp_removable_query_args(), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ), 'customize.php' );
// 				remove_submenu_page( 'themes.php', $customizer_url );
				
// 				/* Plugin related submenus under Settings page */
// 				remove_submenu_page( 'options-general.php', 'webpc_admin_page' ); // WebP converter
// 				remove_submenu_page( 'options-general.php', 'kadence_blocks' ); // Kadence Blocks
			
// 				/* 3rd party plugin menus */
// 				remove_menu_page( 'edit.php?post_type=acf-field-group' );
// 				remove_menu_page( 'postman' );
// 				remove_menu_page( 'cptui_main_menu' );
// 				remove_menu_page('wpseo_dashboard');
// 				// remove_menu_page( 'snippets' ); // Code snippets
// 				// remove_menu_page( 'elementor' ); // Elementor
// 				// remove_menu_page( 'rank-math' ); // Rank Math
// 				// remove_menu_page( 'Wordfence' ); // Wordfence
// 				// remove_menu_page( 'WPML' ); // WPML
// 				// remove_menu_page( 'fluent_forms' ); // Fluent Forms
// 				// remove_menu_page( 'ct-dashboard' ); // Blocksy
// 			}
// }
// add_action('admin_head', 'hide_menu');


// Render fields at the bottom of variations - does not account for field group order or placement.
// add_action( 'woocommerce_product_after_variable_attributes', function( $loop, $variation_data, $variation ) {
//     global $abcdefgh_i; // Custom global variable to monitor index
//     $abcdefgh_i = $loop;
//     // Add filter to update field name
//     add_filter( 'acf/prepare_field', 'acf_prepare_field_update_field_name' );
    
//     // Loop through all field groups
//     $acf_field_groups = acf_get_field_groups();
//     foreach( $acf_field_groups as $acf_field_group ) {
//         foreach( $acf_field_group['location'] as $group_locations ) {
//             foreach( $group_locations as $rule ) {
//                 // See if field Group has at least one post_type = Variations rule - does not validate other rules
//                 if( $rule['param'] == 'post_type' && $rule['operator'] == '==' && $rule['value'] == 'product_variation' ) {
//                     // Render field Group
//                     acf_render_fields( $variation->ID, acf_get_fields( $acf_field_group ) );
//                     break 2;
//                 }
//             }
//         }
//     }
    
//     // Remove filter
//     remove_filter( 'acf/prepare_field', 'acf_prepare_field_update_field_name' );
// }, 10, 3 );

// // Filter function to update field names
// function  acf_prepare_field_update_field_name( $field ) {
//     global $abcdefgh_i;
//     $field['name'] = preg_replace( '/^acf\[/', "acf[$abcdefgh_i][", $field['name'] );
//     return $field;
// }
    
// // Save variation data
// add_action( 'woocommerce_save_product_variation', function( $variation_id, $i = -1 ) {
//     // Update all fields for the current variation
//     if ( ! empty( $_POST['acf'] ) && is_array( $_POST['acf'] ) && array_key_exists( $i, $_POST['acf'] ) && is_array( ( $fields = $_POST['acf'][ $i ] ) ) ) {
//         foreach ( $fields as $key => $val ) {
//             update_field( $key, $val, $variation_id );
//         }
//     }
// }, 10, 2 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Generating dynamic sytles.
 */
require get_template_directory() . '/inc/dynamic-styles.php';
