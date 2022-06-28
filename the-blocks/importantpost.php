<div class="trending">

<?php $postbycategory = new WP_Query (array(
    'posts_per_page' => 1,
    'category_name' => 'uncategorized',
                                    'post_type' => 'post',
                                    'order' => 'DESC',
                                )); while ($postbycategory->have_posts()){
                                    $postbycategory->the_post(); ?>

            <div class="trendingitemcontainer">
                <h2><a href="<?php the_permalink(); ?>">
<?php the_title(); ?></a></h2>
                <div style="background-image: url(<?php
if ( has_post_thumbnail() ) {
echo get_the_post_thumbnail_url();
} else {
bloginfo('template_directory'); ?>/images/default-image.jpg<?php } ?>);" class="trendingitem">
                </div>
            </div>
            <?php }; wp_reset_postdata(); ?>

        </div>

