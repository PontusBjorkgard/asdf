

<div class="asdf-banner jumbotron jumbotron-fluid">

  <div class="container">
    <div class="row">

    <?php
      if ( is_archive() ):

      elseif ( is_single() ):
        dynamic_sidebar( get_post_type() );
      endif;
    ?>

    </div>
  </div>
</div>
