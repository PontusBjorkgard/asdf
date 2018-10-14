

<div class="asdf-banner jumbotron jumbotron-fluid">

  <div class="container">

    <?php
      if ( is_archive() ):
          the_archive_title( '<h1 class="page-title display-3">', '</h1>' );
          the_archive_description( '<div class="archive-description">', '</div>' );
      elseif ( is_single() ): ?>
        <h1 class="display-3"> <?php single_post_title(); ?></h1>
        <h4 class="banner-excerpt"> <?php echo get_post()->post_excerpt ?></h1>
      <?php
      endif;
    ?>


  </div>
</div>
