<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package medycznie
 */
$carousel_image_1 = get_field('carousel_image_1', $post->ID);
$carousel_image_1_header = get_field('carousel_image_1_header', $post->ID);
$carousel_image_1_subheader = get_field('carousel_image_1_subheader', $post->ID);
$carousel_image_1_link = get_field('carousel_image_1_link', $post->ID);

$carousel_image_2 = get_field('carousel_image_2', $post->ID);
$carousel_image_2_header = get_field('carousel_image_2_header', $post->ID);
$carousel_image_2_subheader = get_field('carousel_image_2_subheader', $post->ID);
$carousel_image_2_link = get_field('carousel_image_2_link', $post->ID);

$carousel_image_3 = get_field('carousel_image_3', $post->ID);
$carousel_image_3_header = get_field('carousel_image_3_header', $post->ID);
$carousel_image_3_subheader = get_field('carousel_image_3_subheader', $post->ID);
$carousel_image_3_link = get_field('carousel_image_3_link', $post->ID);

$carousel_image_4 = get_field('carousel_image_4', $post->ID);
$carousel_image_4_header = get_field('carousel_image_4_header', $post->ID);
$carousel_image_4_subheader = get_field('carousel_image_4_subheader', $post->ID);
$carousel_image_4_link = get_field('carousel_image_4_link', $post->ID);

$carousel_image_5 = get_field('carousel_image_5', $post->ID);
$carousel_image_5_header = get_field('carousel_image_5_header', $post->ID);
$carousel_image_5_subheader = get_field('carousel_image_5_subheader', $post->ID);
$carousel_image_5_link = get_field('carousel_image_5_link', $post->ID);

?>

<div class="main-carousel">
<!-- Slider main container -->
<div class="swiper-container swiper-container-main-carousel">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
		<div class="swiper-slide" style="background-image: url();">
			<a class="swiper-slide__link" href="<?php echo $carousel_image_1_link ?>">
				<img src="<?php echo $carousel_image_1["url"] ?>" alt="<?php echo $carousel_image_1["title"]; ?>">
			</a>
		</div>

		<div class="swiper-slide" style="background-image: url();">
			<a class="swiper-slide__link" href="<?php echo $carousel_image_2_link ?>">
				<img src="<?php echo $carousel_image_2["url"] ?>" alt="<?php echo $carousel_image_2["title"]; ?>">
			</a>
		</div>

		<div class="swiper-slide" style="background-image: url();">
			<a class="swiper-slide__link" href="<?php echo $carousel_image_3_link ?>">
				<img src="<?php echo $carousel_image_3["url"] ?>" alt="<?php echo $carousel_image_3["title"]; ?>">
			</a>
		</div>

		<div class="swiper-slide" style="background-image: url();">
			<a class="swiper-slide__link" href="<?php echo $carousel_image_4_link ?>">
				<img src="<?php echo $carousel_image_4["url"] ?>" alt="<?php echo $carousel_image_4["title"]; ?>">
			</a>
		</div>

		<div class="swiper-slide" style="background-image: url();">
			<a class="swiper-slide__link" href="<?php echo $carousel_image_5_link ?>">
				<img src="<?php echo $carousel_image_5["url"] ?>" alt="<?php echo $carousel_image_5["title"]; ?>">
			</a>
		</div>

    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

</div>
</div>
