<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package medycznie
 */
$carousel_image_1_header = get_field('carousel_image_1_header', $post->ID);
$carousel_image_1_subheader = get_field('carousel_image_1_subheader', $post->ID);
$carousel_image_1_link = get_field('carousel_image_1_link', $post->ID);

$carousel_image_2_header = get_field('carousel_image_2_header', $post->ID);
$carousel_image_2_subheader = get_field('carousel_image_2_subheader', $post->ID);
$carousel_image_2_link = get_field('carousel_image_2_link', $post->ID);

$carousel_image_3_header = get_field('carousel_image_3_header', $post->ID);
$carousel_image_3_subheader = get_field('carousel_image_3_subheader', $post->ID);
$carousel_image_3_link = get_field('carousel_image_3_link', $post->ID);

?>

<section class="main-carousel">
<!-- Slider main container -->
<div class="swiper-container swiper-container-main-carousel">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
		<div class="swiper-slide" style="background-image: url(<?php echo get_field('carousel_image_1', $post->ID) ?>);">


			<div class="parallax-title" data-swiper-parallax="-100">
				<a class="swiper-slide__link" href="<?php echo $carousel_image_1_link ?>">
					<?php
						echo '<h2>' .$carousel_image_1_header. '</h2>';
						echo '<p>' .$carousel_image_1_subheader. '</p>';
					?>
				</a>
			</div>


		</div>

		<div class="swiper-slide" style="background-image: url(<?php echo get_field('carousel_image_2', $post->ID) ?>);">
			<div class="parallax-title" data-swiper-parallax="-100">
				<a class="swiper-slide__link" href="<?php echo $carousel_image_2_link ?>">
					<?php
						echo '<h2>' .$carousel_image_2_header. '</h2>';
						echo '<p>' .$carousel_image_2_subheader. '</p>';
					?>
				</a>
			</div>
		</div>

		<div class="swiper-slide" style="background-image: url(<?php echo get_field('carousel_image_3', $post->ID) ?>);">
			<div class="parallax-title" data-swiper-parallax="-100">
				<a class="swiper-slide__link" href="<?php echo $carousel_image_3_link ?>">
					<?php
						echo '<h2>' .$carousel_image_3_header. '</h2>';
						echo '<p>' .$carousel_image_3_subheader. '</p>';
					?>
				</a>
			</div>
		</div>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

</div>
</section>
