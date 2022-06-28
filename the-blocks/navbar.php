        <nav class="navbar navbar-expand-lg sticky-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?php echo site_url() ?>"><?php echo get_bloginfo( 'name' ); ?></a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php wp_nav_menu(array(
						'theme_location' => 'headerMenuLocation',
                        'menu_class'     => 'navitem',
					)); ?>
      </ul>
      <form class="d-flex" role="search">
      <?php get_search_form()?>
      </form>
    </div>
  </div>
</nav>