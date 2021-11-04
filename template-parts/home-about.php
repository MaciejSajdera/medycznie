<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package medycznie
 */
$about = get_field("about");

$about_title = $about['title'];
$about_image = $about['image'];


?>

<section class="home-about reveal-from__trigger">

	<div class="content reveal-from__element reveal-from--bottom">

		<h2><?php echo $about_title ?></h2>

		<div><?php the_content(); ?></div>

	</div>

	<div class="image-holder reveal-from__element reveal-from--bottom">
		<img class="my-lazy-img" src="<?php echo $about_image['url'] ?>" data-srcset="<?php echo $about_image['url'] ?>" alt="<?php echo $about_image['alt'] ?>">
	</div>

</section>
