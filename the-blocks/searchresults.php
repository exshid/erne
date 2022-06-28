<?php
$s=get_search_query();
$args = array(
                's' =>$s
            );
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
        _e("<h2 style='color: grey'>Search Results for: ".get_query_var('s')."</h2><div class='archivepostscontainer'>");
        while ( $the_query->have_posts() ) {
           $the_query->the_post();
                 ?>

<div class="archivepost">
        <img src="<?php
 if ( has_post_thumbnail() ) {
  echo get_the_post_thumbnail_url();
  } else {
  bloginfo('template_directory'); ?>/images/default-image.jpg<?php } ?>" class="archiveimage">
                    <div class="archivecontent">

                    <h2 class="archivetitle">                    <a href="<?php the_permalink(); ?>">
<?php the_title(); ?></a></h2>
                        <p class="archivetext">            <?php
      if (has_excerpt()) {
          echo get_the_excerpt();
      } else {
      echo wp_trim_words(get_the_content(), 20);} ?></p>
                        <div class="archiveauthor">Posted by <?php the_author_posts_link() ?> on <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
  <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
</svg> <?php the_time('F j, Y') ?> </div>
                    </div>

                </div>
                <?php }; wp_reset_postdata(); ?>


                <?php
                }
    else{
?>
        <div class='searchnothingfound'>
        <div class="alert alert-info rounded-0">
          <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
          <?php get_search_form(); ?>

        </div>
<?php } ?>


    </div>