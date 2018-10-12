

<div class="jumbotron jumbotron-fluid" style="<?php asdf_banner_style(); ?>">

  <div class="container">

    <?php
      if ( is_archive() ):
          the_archive_title( '<h1 class="page-title display-3">', '</h1>' );
          the_archive_description( '<div class="archive-description">', '</div>' );
      endif;
    ?>
    <h1 class="display-3"> <?php single_post_title(); ?></h1>

    <h1> <?php echo asdf_get_option('post-elements'); ?> </h1>

  </div>
</div>
