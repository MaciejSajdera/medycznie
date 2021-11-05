<?php

/*
 * Template Name: About Page Template
 * description: >-
  Page template without sidebar
 */

global $post;

$phone_contact_header = get_field("phone_contact_header", get_page_by_title( 'O nas' ));
$phone_number_1 = get_field("phone_number_1", get_page_by_title( 'O nas' ));
$phone_number_2 = get_field("phone_number_2", get_page_by_title( 'O nas' ));
$phone_number_3 = get_field("phone_number_3", get_page_by_title( 'O nas' ));
$phone_number_4 = get_field("phone_number_4", get_page_by_title( 'O nas' ));

$email_address = get_field("email", get_page_by_title( 'O nas' ));
$hq_header = get_field("hq_header", get_page_by_title( 'O nas' ));
$company_full_name = get_field("company_full_name", get_page_by_title( 'O nas' ));

$address_1 = get_field("address_1", get_page_by_title( 'O nas' ));
$address_2 = get_field("address_2", get_page_by_title( 'O nas' ));

$nip = get_field("nip", get_page_by_title( 'O nas' ));
$thank_you_text = get_field("thank_you_text", get_page_by_title( 'O nas' ));


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

						// echo '<div class="contact-data">';

						// 	echo '<h3>'.$phone_contact_header.'</h3>';

						// 	echo '<div class="phone-numbers-wrapper">';

						// 		echo '<a href="tel:'.$phone_number_1.'">'.$phone_number_1.'</a>';
						// 		echo '<a href="tel:'.$phone_number_2.'">'.$phone_number_2.'</a>';
						// 		echo '<a href="tel:'.$phone_number_3.'">'.$phone_number_3.'</a>';
						// 		echo '<a href="tel:'.$phone_number_4.'">'.$phone_number_4.'</a>';

						// 	echo '</div>';

						// 	echo '<p>e-mail: <a href="mailto:'.$email_address.'">'.$email_address.'</a></p>';

						// 	echo '<div class="headquarters-wrapper">';

						// 		echo '<h3>'.$hq_header.'</h3>';
						// 		echo '<p>'.$company_full_name.'</p>';
						// 		echo '<p>'.$address_1.'</p>';
						// 		echo '<p>'.$address_2.'</p>';
						// 		echo '<p>'.$nip.'</p>';

						// 	echo '</div>';

						// 	echo '<p>'.$thank_you_text.'</p>';

						// echo '</div>';


					endwhile; // End of the loop.
					?>

					</main><!-- #main -->
				</div><!-- #primary -->

			</div>

		</div>

	</div>

	
<?php
get_footer();