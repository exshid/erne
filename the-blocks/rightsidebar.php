<div class="siderbar">
<h1 class="whatsnew">Discuss!</h1>

<?php $rightsidebar = new WP_Query (array(
    'paged' => get_query_var('paged',1),
    'posts_per_page' => 5,
    'category_name' => 'uncategorized',
    'post_type' => 'post',
    //'orderby' => 'rand',
    'order' => 'DESC',
)); 

while ($rightsidebar->have_posts()){
    $rightsidebar->the_post(); ?>

<div style="background-image: url(<?php
if ( has_post_thumbnail() ) {
echo get_the_post_thumbnail_url();
} else {
bloginfo('template_directory'); ?>/images/default-image.jpg<?php } ?>);"
                    class="sidebaritem">
                    <div class="title">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </div>
                </div>
                <?php };  wp_reset_postdata();?>

            </div>