<div class="outerslider">
<h2 class="editorspick">Editor's Pick</h2>

<div class="slider">
            <?php $slider = new WP_Query (array(
                                    'posts_per_page' => 4,
                                    'category_name' => 'uncategorized',
                                    'post_type' => 'post',
                                    'order' => 'DESC',
                                )); while ($slider->have_posts()){
                                    $slider->the_post(); ?>
<div class="slideritems" style="background-image: url(<?php the_post_thumbnail_url() ?>)">
<div class="slidertitle">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </div>
                </div>
                <?php }?>

            </div>
        </div>

