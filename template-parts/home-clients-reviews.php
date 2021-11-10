<section class="home-clients-reviews reveal-from__trigger">


    <div class="reveal-from__element reveal-from--bottom">

        <h2 class="section-header">Najnowsze opinie</h2>
        
		<div class="flex-wrapper-mrow-dcol space-between col-gap--8">
            
					<?php

                        $quote_icon = file_get_contents(get_stylesheet_directory_uri().'/dist/dist/svg/left-quote.svg');

                        $reviews = array(
                            'post_type'=> 'reviews',
                            'posts_per_page' => 3,
                            'orderby'        => 'DESC',
                        );    
                        
                        $your_query = new WP_Query( $reviews );
                        
						// "loop" through query (even though it's just one page) 
						while ( $your_query->have_posts() ) :
							$your_query->post_title(); $your_query->the_post();



                            echo '<div class="single-review">';

                                echo '<div>';
                                    echo '<p>' . $quote_icon .' '. wp_encode_emoji(get_the_content()) . '</p>';
                                echo '</div>';

                                echo '<div>';
                                    echo '<p class="text-colored"><strong>' . get_the_title() . '</strong></p>';
                                echo '</div>';

                            echo '</div>';
				
                        endwhile;
                        // reset post data (important!)
                        wp_reset_postdata();
                        ?>

		</div>

    </div>

</section>