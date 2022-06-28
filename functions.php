<?php

function erne_files() {
  wp_enqueue_script('bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js');
  wp_enqueue_style('bootstrap-css', get_theme_file_uri('/css/bootstrap.min.css'));
wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
  wp_enqueue_style('custom-google-fonts2', '//fonts.googleapis.com/css2?family=Cabin&display=swap');
  wp_enqueue_style('erne_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_script('main-erne-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);

  wp_localize_script('main-erne-js', 'erneData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest'),
    'template_url' => get_theme_file_uri()
  ));
}

add_action('wp_enqueue_scripts', 'erne_files');

function erne_features() {
  register_nav_menu('headerMenuLocation', 'Header Menu Location');

  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('editor-styles');
  add_editor_style(array('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap', 'build/style-index.css', '/index.css'));

}

add_action('after_setup_theme', 'erne_features');

function wpb_author_info_box( $content ) {
 
  global $post;
   
  if ( is_single() && isset( $post->post_author ) ) {
   
  $display_name = get_the_author_meta( 'display_name', $post->post_author );
   
  if ( empty( $display_name ) )
  $display_name = get_the_author_meta( 'nickname', $post->post_author );
   
  $user_description = get_the_author_meta( 'user_description', $post->post_author );
   
  $user_website = get_the_author_meta('url', $post->post_author);
  
  $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
   
  if ( ! empty( $display_name ) )
   
  $author_details = '<div class="name-and-picture">' . get_avatar( get_the_author_meta('user_email') , 90 ).'<a href="'. $user_posts .'"><h4 class="author_name">' . $display_name . '</h4></a> </div>';
   
  if ( ! empty( $user_description ) )
   
  $author_details .= '<p class="author_details">' . nl2br( $user_description ). '</p>';
  $content = $content . '<hr><h3 class="abouttheauthor">About the author</h3>'. '<div class="author_bio_section" >' . $author_details . '</div>';
  }
  return $content;
  }
  
  add_action( 'the_content', 'wpb_author_info_box' );
  remove_filter('pre_user_description', 'wp_filter_kses');


function ci_get_related_posts( $post_id, $related_count, $args = array() ) {
  $args = wp_parse_args( (array) $args, array(
    'orderby' => 'rand',
    'return'  => 'query',
  ) );

  $related_args = array(
    'post_type'      => get_post_type( $post_id ),
    'posts_per_page' => $related_count,
    'post_status'    => 'publish',
    'post__not_in'   => array( $post_id ),
    'orderby'        => $args['orderby'],
    'tax_query'      => array()
  );

  $post       = get_post( $post_id );
  $taxonomies = get_object_taxonomies( $post, 'names' );

  foreach ( $taxonomies as $taxonomy ) {
    $terms = get_the_terms( $post_id, $taxonomy );
    if ( empty( $terms ) ) {
      continue;
    }
    $term_list                   = wp_list_pluck( $terms, 'slug' );
    $related_args['tax_query'][] = array(
      'taxonomy' => $taxonomy,
      'field'    => 'slug',
      'terms'    => $term_list
    );
  }

  if ( count( $related_args['tax_query'] ) > 1 ) {
    $related_args['tax_query']['relation'] = 'OR';
  }

  if ( $args['return'] == 'query' ) {
    return new WP_Query( $related_args );
  } else {
    return $related_args;
  }
}

class PlaceholderBlock {
  function __construct($name) {
    $this->name = $name;
    add_action('init', [$this, 'onInit']);
  }

  function ourRenderCallback($attributes, $content) {
    ob_start();
    require get_theme_file_path("/the-blocks/{$this->name}.php");
    return ob_get_clean();
  }

  function onInit() {
    wp_register_script($this->name, get_stylesheet_directory_uri() . "/the-blocks/{$this->name}.js", array('wp-blocks', 'wp-editor'));
    
    register_block_type("theblocktheme/{$this->name}", array(
      'editor_script' => $this->name,
      'render_callback' => [$this, 'ourRenderCallback']
    ));
  }
}

new PlaceholderBlock("searchresults");
new PlaceholderBlock("comments");
new PlaceholderBlock("relatedposts");
new PlaceholderBlock("notfound");
new PlaceholderBlock("mypost");
new PlaceholderBlock("navbar");
new PlaceholderBlock("page");

new PlaceholderBlock("importantpost");
new PlaceholderBlock("postbycategory");
new PlaceholderBlock("latestpostscustom");
new PlaceholderBlock("rightsidebar2");
new PlaceholderBlock("firstpost");
new PlaceholderBlock("rightsidebar");
new PlaceholderBlock("videos");
new PlaceholderBlock("slider");
new PlaceholderBlock("archiveposts");
new PlaceholderBlock("archivesidebar");

class JSXBlock {
  function __construct($name, $renderCallback = null, $data = null) {
    $this->name = $name;
    $this->data = $data;
    $this->renderCallback = $renderCallback;
    add_action('init', [$this, 'onInit']);
  }

  function ourRenderCallback($attributes, $content) {
    ob_start();
    require get_theme_file_path("/the-blocks/{$this->name}.php");
    return ob_get_clean();
  }

  function onInit() {
    wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'));
    
    if ($this->data) {
      wp_localize_script($this->name, $this->name, $this->data);
    }

    $ourArgs = array(
      'editor_script' => $this->name
    );

    if ($this->renderCallback) {
      $ourArgs['render_callback'] = [$this, 'ourRenderCallback'];
    }

    register_block_type("theblocktheme/{$this->name}", $ourArgs);
  }
}

new JSXBlock('footercontainer');
new JSXBlock('container');
new JSXBlock('footer');
?>

