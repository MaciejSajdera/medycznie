<section class="blog-posts reveal-from__trigger">

	<div class="reveal-from__element reveal-from--bottom">

		<div>
			<a href=<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>>
			<h2 class="section-header">Blog</h2>
			</a>
		</div>

		<div class="blog-grid blog-grid-home">
					<?php
						// query for the BLOG page
						// displays only 4 most recent posts
						$your_query = new WP_Query( array('pagename=blog', 'posts_per_page' => 3 ) );
						// "loop" through query (even though it's just one page) 
						while ( $your_query->have_posts() ) :
							$your_query->post_title(); $your_query->the_post();
							$category = get_the_category();

							echo '<a class="blog-post" href="'. get_permalink() .'">';

								echo '<div class="blog-post__image" style="background-image: url('.esc_url(get_the_post_thumbnail_url()).')"></div>';

								echo '<div class="blog-post__text">';
									echo '<p>' . get_the_title() . '<span>'.get_the_date().'</span></p>';
									echo '<p>' .  mb_strimwidth( html_entity_decode(get_the_excerpt()), 0, 240, '...' ) . '</p>';
								echo '</div>';

							 echo '</a>';

				endwhile;
				// reset post data (important!)
				wp_reset_postdata();
				?>

		</div>

		<div class="txt-centered">
		<a class="read-more" href=<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>>Zobacz wszystkie</a>
		</div>

	</div>
</section>
	