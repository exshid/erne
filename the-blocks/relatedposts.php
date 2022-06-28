<h3 class="relatedposttitle">Related Posts</h3>
<?php
 $related = ci_get_related_posts( get_the_ID(), 4 );

if ( $related->have_posts() ):
	?>
<div class="related-posts "> 
			<?php while ( $related->have_posts() ): $related->the_post(); ?>
				<div class="relatedposts relatedpostsphoto"><img src="<?php
 if ( has_post_thumbnail() ) {
  echo get_the_post_thumbnail_url();
  } else {
  bloginfo('template_directory'); ?>/images/default-image.jpg)<?php } ?>" alt=""><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
  <p>                <?php
        if (has_excerpt()) {
            echo get_the_excerpt();
        } else {
        echo wp_trim_words(get_the_content(), 20);} ?></p>
  </div>
			<?php endwhile; ?>
	</div>
	<?php
endif;
wp_reset_postdata();
?>