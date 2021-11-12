<?php

/*
 * Template Name: Contact Page Template
 * description: >-
  Page template without sidebar
 */

get_header();

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
?>

<div id="primary" class="content-area">

	<main id="primary" class="contact">

			<header class="entry-header common-template">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<section class="contact-data-section">

					<div class="contact-data__wrapper">

						<?php

							echo '<div class="contact-data">';

							echo '<p>'.$phone_contact_header.'</p>';

							echo '<div class="phone-numbers-wrapper">';

								echo '<a href="tel:'.$phone_number_1.'">'.$phone_number_1.'</a>';
								echo '<a href="tel:'.$phone_number_2.'">'.$phone_number_2.'</a>';
								echo '<a href="tel:'.$phone_number_3.'">'.$phone_number_3.'</a>';
								echo '<a href="tel:'.$phone_number_4.'">'.$phone_number_4.'</a>';

							echo '</div>';

							echo '<p>e-mail: <a href="mailto:'.$email_address.'">'.$email_address.'</a></p>';

							echo '<div class="headquarters-wrapper">';

								echo '<h3>'.$hq_header.'</h3>';
								echo '<p>'.$company_full_name.'</p>';
								echo '<p>'.$address_1.'</p>';
								echo '<p>'.$address_2.'</p>';
								echo '<p>'.$nip.'</p>';

							echo '</div>';

							echo '<p>'.$thank_you_text.'</p>';

							echo '</div>';

						?>

						<div class="contact-data__wrapper-map">
							<div id="map_wrapper">
								<div class="mapping map_canvas">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3259.336349758181!2d21.157366015923234!3d49.64956785262587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473dc688a4af33f3%3A0x9b8c6d0b8b45adfd!2sPod%20Lodowni%C4%85%207%2C%2038-300%20Gorlice!5e1!3m2!1spl!2spl!4v1636073567490!5m2!1spl!2spl" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
								</div>
							</div>
						</div>

					</div>

			</section>

			<!-- <section class="contact-form-section">
				<div class="contact-form">

					<div class="common-template__header">
						<h4 class="text--center">Masz pytanie?</h4>
					</div>

					<div class="wrapper-flex-column">
							<?php
							// echo  do_shortcode('[contact-form-7 id="14" title="Contact form 1"]');
							?>

							//formularz
					</div>

				</div> 
			</section> -->


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();