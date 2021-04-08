<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package evenus
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				evenus_posted_on();
				evenus_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	

	<div class="entry-content wrapper-flex-row blog-post-container">

	<div class="post-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'evenus' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'evenus' ),
				'after'  => '</div>',
			)
		);
		?>
		</div>
		<?php evenus_post_thumbnail(); ?>
	</div><!-- .entry-content -->

	<div class="post-navigation">

				<div>
				<?php previous_post_link('%link', '<span class="post-navigation__prev">Poprzedni</span> <p>%title</p>'); ?>
			</div>

				<div>

				<?php next_post_link('%link', '<span class="post-navigation__next">Następny</span> <p>%title</p>'); ?>
				</div>

	</div>

	<footer class="entry-footer">
		<?php evenus_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->