<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package medycznie
 */
$abouts = get_field("abouts");

if ($abouts) {
	foreach($abouts as $about) {
	
		?>
	
			<section class="home-about reveal-from__trigger">
	
				<div class="content reveal-from__element reveal-from--bottom">
	
					<div class="title"><?php echo $about['title']?></div>
	
					<div class="text"><?php echo $about['description'] ?></div>
	
				</div>
	
				<div class="image-holder reveal-from__element reveal-from--bottom">
					<img class="my-lazy-img" src="<?php echo $about['image']['url'] ?>" data-srcset="<?php echo $about['image']['url'] ?>" alt="<?php echo $about['image']['alt'] ?>" loading="lazy">
				</div>
	
			</section>
	
		<?php
	}
}

