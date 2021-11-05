<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package medycznie
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header common-template">

		<div>
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
					echo get_the_date();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>

		</div>
	</header><!-- .entry-header -->
	

	<div class="entry-content wrapper-flex-row blog-post-container">

	<div class="post-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'medycznie' ),
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
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'medycznie' ),
				'after'  => '</div>',
			)
		);
		?>
		</div>
		<?php medycznie_post_thumbnail(); ?>
	</div><!-- .entry-content -->

	<div class="post-navigation">

			<div>
				<?php
				$prev_post = get_adjacent_post(false, '', true);
				if(!empty($prev_post)) {
				echo '<a href="' . get_permalink($prev_post->ID) . '" title="' . $prev_post->post_title . '"><span class="post-navigation__prev">Poprzedni</span><p>' . mb_strimwidth( html_entity_decode($prev_post->post_title), 0, 60, '...' ) . '</p></a>'; }
				?>
			</div>

			<div>
				<?php
				$next_post = get_adjacent_post(false, '', false);
				if(!empty($next_post)) {
				echo '<a href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '"><span class="post-navigation__next">Następny</span><p>' . mb_strimwidth( html_entity_decode($next_post->post_title), 0, 60, '...' ) . '</p></a>'; }
				?>
			</div>

	</div>

	<footer class="entry-footer">
		<?php medycznie_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
